(function () {
  const selection = document.getElementById('luTestSelection');
  const container = document.getElementById('luTestContainer');
  if (!selection || !container) return;

  const progressBar = document.getElementById('luProgressBar');
  const stepLabel = document.getElementById('luTestStep');
  const emailSection = document.getElementById('luTestEmail');
  const resultSection = document.getElementById('luTestResult');
  const emailForm = document.getElementById('luEmailForm');

  let currentTest = '';
  let questionIndex = 0;
  let questions = [];
  let answers = [];

  // Start test
  document.querySelectorAll('.lu-start-test').forEach(function (btn) {
    btn.addEventListener('click', function () {
      currentTest = this.dataset.start;
      const prefix = currentTest === 'glueck' ? 'glueck' : 'staerken';
      questions = Array.from(container.querySelectorAll('[data-q^="' + prefix + '"]'));
      questionIndex = 0;
      answers = [];

      selection.style.display = 'none';
      container.style.display = 'block';
      emailSection.style.display = 'none';
      resultSection.style.display = 'none';

      container.querySelectorAll('.lu-test-q').forEach(function (q) { q.style.display = 'none'; });
      questions[0].style.display = 'block';
      progressBar.style.width = '0%';
      stepLabel.textContent = 'Frage 1 von ' + questions.length;
      stepLabel.style.display = 'block';

      container.scrollIntoView({ behavior: 'smooth', block: 'center' });
    });
  });

  // Answer click
  container.addEventListener('click', function (e) {
    var btn = e.target;
    if (!btn.dataset.v) return;

    answers[questionIndex] = parseInt(btn.dataset.v, 10);
    btn.style.borderColor = '#CC2936';
    btn.style.background = 'rgba(204,41,54,0.1)';

    setTimeout(function () {
      questions[questionIndex].style.display = 'none';
      questionIndex++;

      if (questionIndex < questions.length) {
        questions[questionIndex].style.display = 'block';
        progressBar.style.width = ((questionIndex / questions.length) * 100) + '%';
        stepLabel.textContent = 'Frage ' + (questionIndex + 1) + ' von ' + questions.length;
      } else {
        progressBar.style.width = '100%';
        stepLabel.textContent = 'Auswertung';
        emailSection.style.display = 'block';
      }
    }, 300);
  });

  // Email submit
  emailForm.addEventListener('submit', function (e) {
    e.preventDefault();
    var email = emailForm.querySelector('input[type="email"]').value;
    var total = answers.reduce(function (s, v) { return s + v; }, 0);

    var formData = new FormData();
    formData.append('action', 'lu_test_submit');
    formData.append('nonce', luTest.nonce);
    formData.append('email', email);
    formData.append('test_type', currentTest);
    formData.append('score', total);

    fetch(luTest.ajaxUrl, { method: 'POST', body: formData });

    emailSection.style.display = 'none';
    stepLabel.style.display = 'none';
    showResult(total);
  });

  function showResult(total) {
    var maxScore = questions.length * 5;
    var pct = Math.round((total / maxScore) * 100);
    var isGlueck = currentTest === 'glueck';
    var title, text;

    if (pct >= 70) {
      title = isGlueck ? 'Hohes Upgrade-Potenzial!' : 'Viel Entwicklungspotenzial!';
      text = isGlueck
        ? 'Du bist bereit für eine echte Veränderung. Das Seminar könnte genau der richtige nächste Schritt sein.'
        : 'Dein Körper und Geist haben großes Potenzial. Personal Training kann Dir helfen, es freizusetzen.';
    } else if (pct >= 40) {
      title = isGlueck ? 'Gutes Fundament – mit Luft nach oben' : 'Solide Basis vorhanden';
      text = isGlueck
        ? 'Du hast eine solide Basis, aber in einigen Bereichen hält Dich etwas zurück.'
        : 'Du bist auf einem guten Weg. Gezieltes Training hilft Dir, Deine Stärken besser einzusetzen.';
    } else {
      title = isGlueck ? 'Du bist auf einem guten Weg!' : 'Starke Grundlage!';
      text = isGlueck
        ? 'Deine Werte zeigen, dass Du vieles im Griff hast. Ein Impuls-Seminar gibt Dir den letzten Schliff.'
        : 'Du nutzt Dein Potenzial bereits gut. Ein Workshop kann Dir Feinschliff geben.';
    }

    document.getElementById('luResultTitle').textContent = title;
    document.getElementById('luResultScore').textContent = 'Dein Score: ' + pct + '% Upgrade-Potenzial';
    document.getElementById('luResultText').textContent = text;
    resultSection.style.display = 'block';

    setTimeout(function () {
      document.getElementById('luResultMeter').style.width = pct + '%';
    }, 100);
  }
})();
