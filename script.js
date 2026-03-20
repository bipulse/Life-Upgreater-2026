// ===== MOBILE NAV TOGGLE =====
const navToggle = document.querySelector('.nav-toggle');
const navLinks = document.querySelector('.nav-links');

navToggle.addEventListener('click', () => {
  navLinks.classList.toggle('active');
});

// Close nav on link click (mobile)
navLinks.querySelectorAll('a').forEach(link => {
  link.addEventListener('click', () => {
    navLinks.classList.remove('active');
  });
});

// ===== NAVBAR SCROLL EFFECT =====
const navbar = document.querySelector('.navbar');
window.addEventListener('scroll', () => {
  navbar.style.borderBottomColor = window.scrollY > 50 ? '#2a2a2a' : 'transparent';
});

// ===== SELBSTTEST LOGIC =====
const testContainer = document.getElementById('testContainer');
const questions = testContainer.querySelectorAll('.test-question');
const progressBar = document.getElementById('progressBar');
const testStep = document.getElementById('testStep');
const testEmail = document.getElementById('testEmail');
const testResult = document.getElementById('testResult');
const emailForm = document.getElementById('emailForm');

let currentQuestion = 0;
const totalQuestions = questions.length;
const answers = [];

// Handle option click
testContainer.addEventListener('click', (e) => {
  if (!e.target.classList.contains('test-option')) return;

  const value = parseInt(e.target.dataset.value, 10);
  answers[currentQuestion] = value;

  // Visual feedback
  e.target.style.borderColor = '#e63946';
  e.target.style.background = 'rgba(230, 57, 70, 0.15)';

  setTimeout(() => {
    questions[currentQuestion].classList.remove('active');
    currentQuestion++;

    if (currentQuestion < totalQuestions) {
      // Next question
      questions[currentQuestion].classList.add('active');
      const progress = ((currentQuestion) / totalQuestions) * 100;
      progressBar.style.width = progress + '%';
      testStep.textContent = `Frage ${currentQuestion + 1} von ${totalQuestions}`;
    } else {
      // Test complete — show email capture
      progressBar.style.width = '100%';
      testStep.textContent = 'Auswertung';
      testEmail.style.display = 'block';
    }
  }, 300);
});

// Handle email submit
emailForm.addEventListener('submit', (e) => {
  e.preventDefault();

  const email = emailForm.querySelector('input[type="email"]').value;

  // In production: send email + answers to backend/API
  console.log('Lead captured:', { email, answers });

  // Show result
  testEmail.style.display = 'none';
  testStep.style.display = 'none';
  showResult();
});

function showResult() {
  const total = answers.reduce((sum, val) => sum + val, 0);
  const maxScore = totalQuestions * 5;
  const percentage = Math.round((total / maxScore) * 100);

  const resultTitle = document.getElementById('resultTitle');
  const resultScore = document.getElementById('resultScore');
  const resultText = document.getElementById('resultText');
  const resultMeter = document.getElementById('resultMeter');

  let title, text;

  if (percentage >= 70) {
    title = 'Hohes Upgrade-Potenzial erkannt!';
    text = 'Deine Antworten zeigen: Du bist bereit für eine echte Veränderung. Das Durchbruch-Seminar könnte genau der richtige nächste Schritt sein, um dein Potenzial freizusetzen.';
  } else if (percentage >= 40) {
    title = 'Gutes Fundament — mit Luft nach oben';
    text = 'Du hast bereits eine solide Basis, aber in einigen Bereichen hält dich etwas zurück. Ein gezieltes Personal Training kann dir helfen, die nächste Stufe zu erreichen.';
  } else {
    title = 'Du bist auf einem guten Weg!';
    text = 'Deine Werte zeigen, dass du vieles im Griff hast. Ein kurzer Impuls — z.B. durch einen Workshop — kann dir helfen, noch klarer und fokussierter zu werden.';
  }

  resultTitle.textContent = title;
  resultScore.textContent = `Dein Score: ${percentage}% Upgrade-Potenzial`;
  resultText.textContent = text;

  testResult.style.display = 'block';

  // Animate meter
  setTimeout(() => {
    resultMeter.style.width = percentage + '%';
  }, 100);
}

// ===== KONTAKT FORM =====
const kontaktForm = document.getElementById('kontaktForm');
kontaktForm.addEventListener('submit', (e) => {
  e.preventDefault();

  // In production: send to backend
  const formData = new FormData(kontaktForm);
  console.log('Contact form submitted:', Object.fromEntries(formData));

  // Visual confirmation
  kontaktForm.innerHTML = `
    <div style="text-align: center; padding: 40px 0;">
      <p style="font-size: 2rem; margin-bottom: 16px;">✓</p>
      <h3 style="margin-bottom: 8px;">Nachricht gesendet!</h3>
      <p style="color: #a0a0a0;">Ich melde mich innerhalb von 24 Stunden bei dir.</p>
    </div>
  `;
});

// ===== SCROLL ANIMATIONS =====
const observerOptions = {
  threshold: 0.1,
  rootMargin: '0px 0px -40px 0px'
};

const fadeObserver = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.style.opacity = '1';
      entry.target.style.transform = 'translateY(0)';
      fadeObserver.unobserve(entry.target);
    }
  });
}, observerOptions);

// Apply fade-in to sections
document.querySelectorAll('.card, .testimonial, .seminar-box, .test-container').forEach(el => {
  el.style.opacity = '0';
  el.style.transform = 'translateY(24px)';
  el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
  fadeObserver.observe(el);
});
