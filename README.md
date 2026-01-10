# CAPTCHaStar - Semantic Sponsored CAPTCHA

<p align="center">
  <img src="app/demo/pages/tutorial.gif" alt="CAPTCHaStar Demo" width="300">
</p>

<p align="center">
  <strong>A novel CAPTCHA system that matches brand logos to website content using semantic analysis</strong>
</p>

<p align="center">
  <a href="#features">Features</a> •
  <a href="#how-it-works">How It Works</a> •
  <a href="#demo">Demo</a> •
  <a href="#installation">Installation</a> •
  <a href="#license">License</a>
</p>

---

## Overview

CAPTCHaStar is an innovative **Sponsored CAPTCHA** system developed as a Bachelor's thesis project at **Sapienza University of Rome**. Unlike traditional CAPTCHAs, it uses Natural Language Processing (NLP) to display brand logos that are semantically relevant to the webpage content.

**Example:** A sports website shows Nike, Adidas, or NBA logos. A tech site shows Apple, Google, or Microsoft.

## Features

- **Semantic Matching** - Uses TF-IDF and GloVe word embeddings to analyze webpage content
- **355+ Brand Logos** - Curated database across 15 categories
- **Real-time Processing** - Logo matching happens dynamically, not hardcoded
- **Interactive Challenge** - Moving dot pattern that reveals a logo shape
- **Mobile Friendly** - Touch-enabled with swipe controls
- **Fast** - Optimized batch queries (~50ms response time)

## How It Works

```
┌─────────────────┐     ┌──────────────────┐     ┌─────────────────┐
│   User visits   │────▶│  Extract text &  │────▶│  TF-IDF finds   │
│    webpage      │     │  remove stopwords│     │   top keywords  │
└─────────────────┘     └──────────────────┘     └─────────────────┘
                                                          │
                                                          ▼
┌─────────────────┐     ┌──────────────────┐     ┌─────────────────┐
│  Show matching  │◀────│ Cosine similarity│◀────│ Convert to 100d │
│   brand logo    │     │  with 355+ logos │     │  GloVe vectors  │
└─────────────────┘     └──────────────────┘     └─────────────────┘
```

1. **Content Extraction** - Webpage text is extracted and cleaned
2. **TF-IDF Analysis** - Important keywords are identified
3. **Word Embeddings** - Keywords converted to 100-dimensional GloVe vectors
4. **Cosine Similarity** - Page vector compared with pre-computed logo vectors
5. **Logo Display** - Top matching logo shown as interactive CAPTCHA

## Demo

The project includes 10 themed demo websites to showcase the semantic matching:

| Category | Topics | Example Logos |
|----------|--------|---------------|
| Sports | Football, NBA, Olympics | Nike, Adidas, UEFA |
| Gaming | PlayStation, PC, Mobile | Xbox, Steam, Nintendo |
| Auto & Moto | Cars, Racing, Motorcycles | Ferrari, Mercedes, Harley |
| Music | Bands, Streaming, Instruments | Spotify, Fender, Rolling Stones |
| Tech | Smartphones, AI, Software | Apple, Google, Microsoft |
| Fashion | Luxury, Streetwear, Accessories | Gucci, Nike, Louis Vuitton |
| Food & Drinks | Restaurants, Beverages | McDonald's, Coca-Cola, Starbucks |
| Beauty | Skincare, Cosmetics, Fragrance | L'Oreal, Chanel, Nivea |
| Environment | Conservation, Recycling | WWF, Greenpeace, UNESCO |
| Entertainment | Movies, TV, Celebrities | Disney, Marvel, Warner Bros |

## Tech Stack

- **Backend:** PHP 8+
- **Database:** MySQL (word vectors + logo keywords)
- **Frontend:** Vanilla JavaScript, HTML5 Canvas
- **NLP:** GloVe 100d word embeddings, TF-IDF
- **Similarity:** Cosine similarity

## Installation

### Requirements
- PHP 8.0+
- MySQL 5.7+
- Web server (Apache/Nginx) or PHP built-in server

### Setup

1. Clone the repository:
```bash
git clone https://github.com/giuseppetallini2525/captcha-star.git
cd captcha-star
```

2. Configure database connection:
```bash
cp config.example.php config.php
# Edit config.php with your database credentials
```

3. Create and import the database:
```bash
mysql -u root -p -e "CREATE DATABASE captcha_star"
mysql -u root -p captcha_star < data/database.sql
```

4. **Download logos and generate embeddings:**

   The logo images and word embeddings are not included in the repository due to size.
   Run the scraping scripts to populate the data:
   ```bash
   # Download logo images and extract keywords from Wikipedia
   php scripts/scrape.php

   # Generate word embeddings (requires GloVe vectors)
   php scripts/generate_embeddings.php
   ```

   > **Note:** Contact the repository owner if you need pre-built data files.

5. Start the server:
```bash
php -S localhost:8000
```

6. Visit `http://localhost:8000/app/demo/index.php`

## Project Structure

```
captcha-star/
├── app/
│   ├── demo/
│   │   ├── index.php          # Landing page
│   │   └── pages/             # 10 themed demo sites
│   └── survey/                # Original survey interface
├── lib/
│   ├── similarity.php         # Semantic matching algorithm (MIT)
│   ├── getter.php             # CAPTCHA generation (Restricted)
│   └── verify.php             # Solution verification (Restricted)
├── logos/                     # 355+ brand logo images
├── data/                      # Database exports
├── LICENSE                    # MIT License (most files)
└── LICENSE-CAPTCHA-CORE       # Restrictive license (core CAPTCHA)
```

## License

This project uses **dual licensing**:

### MIT License (Open Source)
The following components are freely available under the MIT License:
- Semantic similarity algorithm (`lib/similarity.php`)
- Demo websites (`app/demo/`)
- Frontend styles and layouts
- Database structure and logo keywords

### Restrictive License (Permission Required)
The following CAPTCHA core files require permission for use:
- `lib/getter.php` - Point generation algorithm
- `lib/verify.php` - Solution verification
- Canvas JavaScript code in survey pages

**To request permission**, please [open an issue](https://github.com/giuseppetallini2525/captcha-star/issues) or contact me directly.

See [LICENSE](LICENSE) and [LICENSE-CAPTCHA-CORE](LICENSE-CAPTCHA-CORE) for full terms.

## Academic Context

This project was developed as part of a **Bachelor's thesis in Computer Science** at Sapienza University of Rome. The research explores the intersection of:
- Web security (bot protection)
- Natural Language Processing
- Digital advertising (contextual brand exposure)

## Author

**Giuseppe** - Sapienza University of Rome

---

<p align="center">
  <sub>Built with ❤️ at Sapienza University of Rome</sub>
</p>
