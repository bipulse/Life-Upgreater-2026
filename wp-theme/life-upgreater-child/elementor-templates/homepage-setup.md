# Life Upgreater® – Elementor Pro + Crocoblock Setup-Anleitung

## Voraussetzungen

### Plugins installieren & aktivieren:
1. **Elementor Pro** (Lizenz erforderlich)
2. **Crocoblock** Plugins:
   - JetEngine (Custom Post Types, Listings)
   - JetElements (erweiterte Widgets)
   - JetPopup (Popups für Lead-Capture)
3. **Hello Elementor** Theme (kostenlos)
4. **Life Upgreater Child Theme** (dieses Theme)

### Theme aktivieren:
1. ZIP-Datei des `life-upgreater-child` Ordners erstellen
2. WordPress → Design → Themes → Neu hinzufügen → Theme hochladen
3. "Life Upgreater Child" aktivieren

---

## Schritt 1: Elementor Globale Einstellungen

### Farben (Elementor → Einstellungen → Allgemein → Standardfarben):
| Name              | Hex       |
|-------------------|-----------|
| Primary           | #CC2936   |
| Secondary         | #1A1A1A   |
| Text              | #FFFFFF   |
| Accent            | #C8A951   |

### Schriften (Globale Schriften):
| Name      | Font   | Gewicht |
|-----------|--------|---------|
| Primary   | Inter  | 800     |
| Secondary | Inter  | 400     |
| Accent    | Caveat | 600     |

---

## Schritt 2: Custom Post Types (bereits in functions.php)

Das Child Theme registriert automatisch:
- **Seminare** (`lu_seminar`) – mit Feldern: Datum, Ort, Preis, Frühbucher-Preis, Freie Plätze
- **Testimonials** (`lu_testimonial`) – mit Feldern: Rolle, Kategorie

### Beispiel-Inhalte anlegen:

**Seminare:**
1. "HappyMe-HappyFamily" – 26.04.2026, Aachen, 497€ (Frühbucher), 697€ (normal), 6 Plätze
2. "Durchbruch-Wochenende" – 14.06.2026, Online, 397€

**Testimonials:**
1. Marcel Mobertz – "Alemannia Aachen, Aufsichtsratsvorsitzender" – Business
2. Seminar-Teilnehmerin – "HappyMe-HappyFamily" – Seminar
3. Personal Training Kunde – "Blickwinkel Training®" – Personal
4. Firmenkunde – "Business Training" – Business

---

## Schritt 3: Homepage in Elementor aufbauen

### Sektion-für-Sektion Anleitung:

#### 1. Hero Section
- **Typ:** Elementor Section, Full Width
- **Hintergrund:** Gradient (#1A1A1A → #2A2220) + Bild-Overlay (Marco auf Bühne)
- **Höhe:** Min. 90vh
- **Inhalt:**
  - Heading H1: "Entfalte Dein volles Potenzial mit Life Upgreater®"
  - Text: "Trainiere körperlich & mental – um glücklich & gesund zu sein."
  - 2x Button: "Finde Dein Angebot" (Primary) + "Kostenloser Selbsttest →" (Outline)
  - HTML Widget: `<span class="lu-handwriting">Upgreat your Life</span>`
- **CSS Klasse:** `lu-section-dark`

#### 2. Über uns
- **Typ:** Section, 2 Spalten (60/40)
- **Hintergrund:** #2A2220
- **Links:** Section Label + H2 + Text + Button
- **Rechts:** Bild (Marco & Lisa)
- **CSS Klasse:** `lu-section-warm-dark`

#### 3. Angebote (3 Karten)
- **Typ:** Section, 3 Spalten
- **Hintergrund:** #F5F5F5
- **Pro Spalte:** Image Box oder Inner Section
  - Bild oben (16:9)
  - Titel + Untertitel + Text + CTA Button
- **CSS Klasse:** `lu-section-light`
- **Tipp:** JetElements "Advanced Cards" Widget verwenden

#### 4. Seminare Highlight
- **Typ:** Section, 2 Spalten (55/45)
- **Hintergrund:** #1A1A1A
- **Links:** Section Label + H2 + Termin-Info + Text + Button
- **Rechts:** Bild (Seminar-Session)
- **Dynamisch mit JetEngine:**
  - Listing Template für `lu_seminar` erstellen
  - Nächsten Termin per Query filtern (Datum ≥ heute)

#### 5. Testimonials
- **Typ:** Section, Full Width
- **Hintergrund:** #F5F5F5
- **Widget:** JetElements Testimonials Carousel
  - Source: Custom Post Type `lu_testimonial`
  - Quote Mark Farbe: #C8A951 (Gold)
  - Auto-Rotation: 6 Sekunden
  - Dots Navigation
- **CSS Klasse:** `lu-section-light`

#### 6. Zitat
- **Typ:** Section, zentriert
- **Hintergrund:** #2A2220
- **Inhalt:**
  - HTML: `<span class="lu-big-quote-mark">"</span>`
  - Text Editor: Zitat von Marco
  - Text: "– Marco Fuchs, Gründer Life Upgreater®"
- **Padding:** 120px top/bottom

#### 7. Selbsttest
- **Typ:** Section
- **Hintergrund:** #F5F5F5
- **Widget:** Shortcode `[lu_selbsttest]`
- **CSS Klasse:** `lu-section-light`

---

## Schritt 4: JetPopup für Lead-Capture (optional)

1. JetPopup → Neues Popup erstellen
2. Trigger: "Nach X Sekunden" (30s) oder "Exit Intent"
3. Inhalt: "Kostenloser Selbsttest – Finde Deinen Startpunkt"
4. Button → Link zum Selbsttest-Bereich

---

## Schritt 5: Header & Footer mit Elementor Pro

### Header (Theme Builder):
- Logo links: "Life Upgreater®"
- Nav Menü: Seminare, Business Training, Personal Training, Über uns, Selbsttest
- Rechts: Roter "Kontakt" Button
- Sticky: Ja
- Hintergrund: #1A1A1A mit 95% Opacity + Blur

### Footer (Theme Builder):
- 3 Spalten: Kontakt / Angebote / Newsletter
- Kontaktdaten: Marco & Lisa Fuchs + Telefonnummern
- Newsletter: Formular (MailerLite oder Elementor Forms)
- Footer-Links: Impressum, Datenschutz, AGB etc.
- Hintergrund: #1A1A1A

---

## Spam-Schutz

Das Child Theme enthält bereits:
- **Honeypot-Feld** im Kontaktformular
- **Rate Limiting** (max. 3 Mails pro IP pro Stunde)
- **WordPress Nonce** Verifizierung

Zusätzlich empfohlen:
- **reCAPTCHA v3** in Elementor Forms aktivieren
- **Akismet** Plugin installieren
