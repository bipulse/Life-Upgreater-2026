# Life Upgreater 2026 - Website Redesign

**Repository:** [github.com/bipulse/Life-Upgreater-2026](https://github.com/bipulse/Life-Upgreater-2026)

## Projekt

Redesign der Website von **Life Upgreater(R)** - einem Anbieter fuer Personal- und Blickwinkel Training in Aachen. Gruender: Marco & Lisa Fuchs.

**Ziel:** Eine moderne, conversion-fokussierte Website, die Leads fuer Seminare, Personal Training und Business Training generiert.

**Website:** [www.life-upgreater.com](https://www.life-upgreater.com)

## Angebote

| Angebot | Beschreibung |
|---------|-------------|
| **Seminare** | HappyMe-HappyFamily, Familien-/Paar-/Gesundheitsworkshops (skalierbares Hauptprodukt) |
| **Personal Training** | 1:1 Coaching mit Marco & Lisa, inkl. Blickwinkel Training(R), Mamaletics(R), Yogaletics(R) |
| **Business Training** | Firmenfitness, Gesundheitstage, Teambuilding fuer Unternehmen |

## Zielgruppen

| Persona | Alter | Fokus |
|---------|-------|-------|
| Julia (gestresste Managerin) | 32 | Work-Life-Balance, Stressabbau |
| Markus (einsamer Rentner) | 68 | Soziale Interaktion, geistige Aktivitaet |
| Lena (junge Mutter) | 28 | Selbstfuersorge, Unsicherheit |
| Tom (Student) | 21 | Pruefungsangst, Selbstvertrauen |

## Design System

| Token | Wert | Verwendung |
|-------|------|------------|
| Dark BG | `#1A1A1A` / `#2A2220` | Haupthintergrund |
| CTA Red | `#CC2936` | Call-to-Action Buttons |
| White | `#FFFFFF` | Text auf dunklem Hintergrund |
| Light Gray | `#F5F5F5` | Helle Sektionen |
| Gold/Beige | `#C8A951` | Premium-Akzente |
| Trust Bar Blue | `#1B2A4A` | Vertrauensleiste |

**Schrift:** DIN Alternate Bold (vorhanden unter `site/fonts/`)

## Seitenstruktur (Homepage)

0. **Navigation** - Sticky: Logo | Seminare | Business Training | Personal Training | Ueber uns | Selbsttest | Kontakt (roter Button)
1. **Hero** - 90vh, Marco-Foto, "Entfalte Dein volles Potenzial" + 2 CTAs
2. **Trust Bar** - "Seit 2017 aktiv" | "500+ Teilnehmer" | "4.9 Bewertung" | "Aachen & Online"
3. **Ueber uns Teaser** - Marco & Lisa Vorstellung, 60/40 Text/Bild
4. **Angebote** - 3 Karten auf hellem Hintergrund
5. **Seminar Highlight** - Naechster Termin mit Countdown
6. **Testimonials** - Karussell mit 3-4 Kundenstimmen
7. **Inspirational Quote** - Eigenes Zitat, Gold-Akzente
8. **Selbsttest (Lead Magnet)** - 2 kostenlose Tests mit E-Mail-Erfassung
9. **Footer** - 3 Spalten (Kontakt+WhatsApp, Angebote, Newsletter)

## Conversion-Strategie

- Fokus auf 3 Landing Pages (Seminare als skalierbarstes Produkt)
- Trust Bar direkt unter dem Hero
- Selbsttest als Lead Magnet mit E-Mail-Erfassungsschritt
- Conversion-optimierte Texte statt Platzhalter
- WhatsApp-Icons fuer einfachen Erstkontakt

## Projektstruktur

```
life-upgreater-2026/
├── PROJECT.md              # Diese Datei
├── docs/
│   ├── homepage_spezifikation.docx   # Original-Spezifikation
│   └── homepage_spezifikation.txt    # Text-Version
├── resources/
│   ├── life-upgreater-final.pdf      # Design-Mockup
│   ├── life_upgreater_links.xlsx     # Link-Sammlung
│   ├── din-alternate-bold.zip        # Schriftdatei (ZIP)
│   └── din-font/                     # Extrahierte Schrift
└── site/
    ├── fonts/
    │   └── din-alternate-bold.otf    # Web-Font
    └── img/                          # Bilder (noch leer)
```

## Kontakt

- **Marco Fuchs:** 0173-19 49 242
- **Lisa Fuchs:** 0176-644 711 48
- **E-Mail:** info@life-upgreater.com
