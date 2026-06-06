<?php if (!defined('ABSPATH')) exit; ?>

<div class="lu-selbsttest-wrapper">
  <!-- Test-Auswahl -->
  <div class="lu-test-selection" id="luTestSelection">
    <div class="lu-test-card" data-test="glueck">
      <div class="lu-freebee-badge">FREEBEE</div>
      <h3>Wie glücklich bin ich?</h3>
      <p>Finde heraus, wie es um Deine Lebenszufriedenheit steht.</p>
      <button class="elementor-button lu-btn-primary lu-start-test" data-start="glueck">Jetzt testen – kostenlos</button>
    </div>
    <div class="lu-test-card" data-test="staerken">
      <div class="lu-freebee-badge">FREEBEE</div>
      <h3>Was kann ich?</h3>
      <p>Entdecke Deine Stärken und Entwicklungsbereiche.</p>
      <button class="elementor-button lu-btn-primary lu-start-test" data-start="staerken">Jetzt testen – kostenlos</button>
    </div>
  </div>

  <!-- Test Container -->
  <div class="lu-test-container" id="luTestContainer" style="display:none;">
    <div class="lu-test-progress"><div class="lu-test-progress-bar" id="luProgressBar"></div></div>
    <p class="lu-test-step" id="luTestStep">Frage 1 von 5</p>

    <!-- Glückstest -->
    <div class="lu-test-q" data-q="glueck-1"><h3>Wie zufrieden bist Du mit Deiner aktuellen Lebenssituation?</h3><div class="lu-test-opts"><button data-v="1">Sehr unzufrieden</button><button data-v="2">Eher unzufrieden</button><button data-v="3">Geht so</button><button data-v="4">Eher zufrieden</button><button data-v="5">Sehr zufrieden</button></div></div>
    <div class="lu-test-q" data-q="glueck-2"><h3>Wie oft fühlst Du Dich im Alltag energielos oder ausgebrannt?</h3><div class="lu-test-opts"><button data-v="5">Täglich</button><button data-v="4">Mehrmals pro Woche</button><button data-v="3">Gelegentlich</button><button data-v="2">Selten</button><button data-v="1">Nie</button></div></div>
    <div class="lu-test-q" data-q="glueck-3"><h3>Hast Du klare Ziele für die nächsten 12 Monate?</h3><div class="lu-test-opts"><button data-v="5">Nein, gar nicht</button><button data-v="4">Vage Vorstellungen</button><button data-v="3">Teilweise</button><button data-v="2">Ja, größtenteils</button><button data-v="1">Ja, glasklar</button></div></div>
    <div class="lu-test-q" data-q="glueck-4"><h3>Wie gut kannst Du Grenzen setzen – beruflich und privat?</h3><div class="lu-test-opts"><button data-v="5">Sehr schlecht</button><button data-v="4">Eher schlecht</button><button data-v="3">Mittelmäßig</button><button data-v="2">Eher gut</button><button data-v="1">Sehr gut</button></div></div>
    <div class="lu-test-q" data-q="glueck-5"><h3>Wie oft schiebst Du wichtige Entscheidungen vor Dir her?</h3><div class="lu-test-opts"><button data-v="5">Ständig</button><button data-v="4">Oft</button><button data-v="3">Manchmal</button><button data-v="2">Selten</button><button data-v="1">Nie</button></div></div>

    <!-- Stärkentest -->
    <div class="lu-test-q" data-q="staerken-1"><h3>Wie gut kennst Du Deine persönlichen Stärken?</h3><div class="lu-test-opts"><button data-v="5">Gar nicht</button><button data-v="4">Kaum</button><button data-v="3">Teilweise</button><button data-v="2">Gut</button><button data-v="1">Sehr gut</button></div></div>
    <div class="lu-test-q" data-q="staerken-2"><h3>Wie fit fühlst Du Dich körperlich im Alltag?</h3><div class="lu-test-opts"><button data-v="5">Sehr unfit</button><button data-v="4">Eher unfit</button><button data-v="3">Mittelmäßig</button><button data-v="2">Eher fit</button><button data-v="1">Topfit</button></div></div>
    <div class="lu-test-q" data-q="staerken-3"><h3>Wie regelmäßig bewegst Du Dich sportlich?</h3><div class="lu-test-opts"><button data-v="5">Nie</button><button data-v="4">Selten (1x/Monat)</button><button data-v="3">Gelegentlich (1x/Woche)</button><button data-v="2">Regelmäßig (2-3x/Woche)</button><button data-v="1">Täglich</button></div></div>
    <div class="lu-test-q" data-q="staerken-4"><h3>Hast Du Spaß an dem, was Du beruflich machst?</h3><div class="lu-test-opts"><button data-v="5">Überhaupt nicht</button><button data-v="4">Eher nicht</button><button data-v="3">Geht so</button><button data-v="2">Meistens ja</button><button data-v="1">Absolut</button></div></div>
    <div class="lu-test-q" data-q="staerken-5"><h3>Wie gut bringst Du Beruf und Privatleben in Einklang?</h3><div class="lu-test-opts"><button data-v="5">Sehr schlecht</button><button data-v="4">Eher schlecht</button><button data-v="3">Mittelmäßig</button><button data-v="2">Eher gut</button><button data-v="1">Sehr gut</button></div></div>

    <!-- E-Mail Capture -->
    <div class="lu-test-email" id="luTestEmail" style="display:none;">
      <h3>📊 Dein Ergebnis ist fertig!</h3>
      <p>Gib Deine E-Mail-Adresse ein und erhalte Deine persönliche Auswertung – kostenlos.</p>
      <form id="luEmailForm"><input type="email" placeholder="Deine E-Mail-Adresse" required><button type="submit" class="elementor-button lu-btn-primary">Ergebnis erhalten</button></form>
      <p class="lu-email-note">Kein Spam. Du kannst Dich jederzeit abmelden.</p>
    </div>

    <!-- Ergebnis -->
    <div class="lu-test-result" id="luTestResult" style="display:none;">
      <h3 id="luResultTitle"></h3>
      <div class="lu-result-meter"><div class="lu-result-fill" id="luResultMeter"></div></div>
      <p class="lu-result-score" id="luResultScore"></p>
      <p id="luResultText"></p>
      <a href="/seminare" class="elementor-button lu-btn-primary">Dein nächster Schritt →</a>
    </div>
  </div>
</div>
