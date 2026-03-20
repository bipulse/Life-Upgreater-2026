// ===== MOBILE NAV TOGGLE =====
const navToggle = document.querySelector('.nav-toggle');
const navLinks = document.querySelector('.nav-links');

navToggle.addEventListener('click', () => {
  navLinks.classList.toggle('active');
});

navLinks.querySelectorAll('a').forEach(link => {
  link.addEventListener('click', () => {
    navLinks.classList.remove('active');
  });
});

// ===== TESTIMONIAL CAROUSEL =====
const track = document.getElementById('testimonialTrack');
const dotsContainer = document.getElementById('carouselDots');
const slides = track.querySelectorAll('.testimonial-slide');
let currentSlide = 0;
let autoRotate;

// Create dots
slides.forEach((_, i) => {
  const dot = document.createElement('button');
  dot.classList.add('carousel-dot');
  if (i === 0) dot.classList.add('active');
  dot.setAttribute('aria-label', `Testimonial ${i + 1}`);
  dot.addEventListener('click', () => goToSlide(i));
  dotsContainer.appendChild(dot);
});

function goToSlide(index) {
  currentSlide = index;
  track.style.transform = `translateX(-${index * 100}%)`;
  dotsContainer.querySelectorAll('.carousel-dot').forEach((dot, i) => {
    dot.classList.toggle('active', i === index);
  });
}

function nextSlide() {
  goToSlide((currentSlide + 1) % slides.length);
}

function startAutoRotate() {
  autoRotate = setInterval(nextSlide, 6000);
}

startAutoRotate();

// Pause on hover
const carousel = document.getElementById('testimonialCarousel');
carousel.addEventListener('mouseenter', () => clearInterval(autoRotate));
carousel.addEventListener('mouseleave', startAutoRotate);

// ===== SELBSTTEST LOGIC =====
const testSelection = document.getElementById('testSelection');
const testContainer = document.getElementById('testContainer');
const progressBar = document.getElementById('progressBar');
const testStep = document.getElementById('testStep');
const testEmail = document.getElementById('testEmail');
const testResult = document.getElementById('testResult');
const emailForm = document.getElementById('emailForm');

let currentTest = '';
let currentQuestionIndex = 0;
let testQuestions = [];
let answers = [];

// Start test when clicking a test card button
document.querySelectorAll('[data-start]').forEach(btn => {
  btn.addEventListener('click', (e) => {
    e.preventDefault();
    currentTest = btn.dataset.start;
    startTest(currentTest);
  });
});

function startTest(testType) {
  // Get questions for this test type
  const prefix = testType === 'glueck' ? 'glueck' : 'staerken';
  testQuestions = Array.from(testContainer.querySelectorAll(`[data-question^="${prefix}"]`));

  if (testQuestions.length === 0) return;

  // Reset
  currentQuestionIndex = 0;
  answers = [];

  // Hide selection, show test container
  testSelection.style.display = 'none';
  testContainer.style.display = 'block';

  // Hide all questions, show first
  testContainer.querySelectorAll('.test-question').forEach(q => q.classList.remove('active'));
  testQuestions[0].classList.add('active');

  // Reset progress
  progressBar.style.width = '0%';
  testStep.textContent = `Frage 1 von ${testQuestions.length}`;
  testStep.style.display = 'block';

  // Hide result/email
  testEmail.style.display = 'none';
  testResult.style.display = 'none';

  // Scroll to test
  testContainer.scrollIntoView({ behavior: 'smooth', block: 'center' });
}

// Handle option click
testContainer.addEventListener('click', (e) => {
  if (!e.target.classList.contains('test-option')) return;

  const value = parseInt(e.target.dataset.value, 10);
  answers[currentQuestionIndex] = value;

  // Visual feedback
  e.target.style.borderColor = '#CC2936';
  e.target.style.background = 'rgba(204, 41, 54, 0.1)';

  setTimeout(() => {
    testQuestions[currentQuestionIndex].classList.remove('active');
    currentQuestionIndex++;

    if (currentQuestionIndex < testQuestions.length) {
      testQuestions[currentQuestionIndex].classList.add('active');
      const progress = (currentQuestionIndex / testQuestions.length) * 100;
      progressBar.style.width = progress + '%';
      testStep.textContent = `Frage ${currentQuestionIndex + 1} von ${testQuestions.length}`;
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
  console.log('Lead captured:', { email, test: currentTest, answers });

  testEmail.style.display = 'none';
  testStep.style.display = 'none';
  showResult();
});

function showResult() {
  const total = answers.reduce((sum, val) => sum + val, 0);
  const maxScore = testQuestions.length * 5;
  const percentage = Math.round((total / maxScore) * 100);

  const resultTitle = document.getElementById('resultTitle');
  const resultScore = document.getElementById('resultScore');
  const resultText = document.getElementById('resultText');
  const resultMeter = document.getElementById('resultMeter');

  let title, text;
  const isGlueck = currentTest === 'glueck';

  if (percentage >= 70) {
    title = isGlueck ? 'Hohes Upgrade-Potenzial!' : 'Viel Entwicklungspotenzial!';
    text = isGlueck
      ? 'Deine Antworten zeigen: Du bist bereit für eine echte Veränderung. Das Seminar könnte genau der richtige nächste Schritt sein.'
      : 'Dein Körper und Geist haben großes Potenzial. Ein gezieltes Personal Training kann Dir helfen, dieses freizusetzen.';
  } else if (percentage >= 40) {
    title = isGlueck ? 'Gutes Fundament – mit Luft nach oben' : 'Solide Basis vorhanden';
    text = isGlueck
      ? 'Du hast eine solide Basis, aber in einigen Bereichen hält Dich etwas zurück. Ein Coaching kann Dir helfen, die nächste Stufe zu erreichen.'
      : 'Du bist bereits auf einem guten Weg. Gezieltes Training kann Dir helfen, Deine Stärken noch besser einzusetzen.';
  } else {
    title = isGlueck ? 'Du bist auf einem guten Weg!' : 'Starke Grundlage!';
    text = isGlueck
      ? 'Deine Werte zeigen, dass Du vieles im Griff hast. Ein Impuls-Seminar kann Dir helfen, noch klarer und fokussierter zu werden.'
      : 'Du nutzt Dein Potenzial bereits gut. Ein Workshop kann Dir den letzten Feinschliff geben.';
  }

  resultTitle.textContent = title;
  resultScore.textContent = `Dein Score: ${percentage}% Upgrade-Potenzial`;
  resultText.textContent = text;

  testResult.style.display = 'block';

  setTimeout(() => {
    resultMeter.style.width = percentage + '%';
  }, 100);
}

// ===== NEWSLETTER FORM =====
const newsletterForm = document.getElementById('newsletterForm');
newsletterForm.addEventListener('submit', (e) => {
  e.preventDefault();
  console.log('Newsletter signup:', new FormData(newsletterForm));
  newsletterForm.innerHTML = `
    <p style="color: #CC2936; font-weight: 600; padding: 16px 0;">
      ✓ Erfolgreich angemeldet! Willkommen bei Life Upgreater®.
    </p>
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

document.querySelectorAll('.card-light, .testimonial-slide, .test-card, .ueber-grid, .seminare-grid, .big-quote').forEach(el => {
  el.style.opacity = '0';
  el.style.transform = 'translateY(24px)';
  el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
  fadeObserver.observe(el);
});
