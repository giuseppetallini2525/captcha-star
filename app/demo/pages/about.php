<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About CAPTCHaStar - How It Works</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --secondary: #7c3aed;
            --success: #10b981;
            --text: #1f2937;
            --text-light: #6b7280;
            --bg: #f9fafb;
            --white: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, sans-serif;
            background: var(--bg);
            color: var(--text);
            line-height: 1.7;
        }

        /* Header */
        header {
            background: var(--white);
            padding: 1rem 2rem;
            border-bottom: 1px solid #e5e7eb;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 800;
            text-decoration: none;
            color: var(--text);
        }

        .logo .highlight {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: var(--bg);
            color: var(--text);
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.2s;
        }

        .back-btn:hover {
            background: var(--primary);
            color: white;
        }

        /* Hero */
        .hero {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 4rem 2rem;
            text-align: center;
        }

        .hero h1 {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
        }

        .hero p {
            font-size: 1.25rem;
            opacity: 0.9;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Content */
        .content {
            max-width: 900px;
            margin: 0 auto;
            padding: 3rem 2rem;
        }

        .section {
            background: var(--white);
            border-radius: 16px;
            padding: 2.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        }

        .section h2 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: var(--primary);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .section h2 .icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }

        .section p {
            color: var(--text-light);
            margin-bottom: 1rem;
            font-size: 1.05rem;
        }

        .section p:last-child {
            margin-bottom: 0;
        }

        .section ul {
            list-style: none;
            margin: 1.5rem 0;
        }

        .section ul li {
            padding: 0.75rem 0;
            padding-left: 2rem;
            position: relative;
            color: var(--text-light);
        }

        .section ul li::before {
            content: '';
            position: absolute;
            left: 0;
            top: 1rem;
            width: 8px;
            height: 8px;
            background: var(--primary);
            border-radius: 50%;
        }

        .highlight-box {
            background: linear-gradient(135deg, rgba(37,99,235,0.1), rgba(124,58,237,0.1));
            border-left: 4px solid var(--primary);
            padding: 1.5rem;
            border-radius: 0 12px 12px 0;
            margin: 1.5rem 0;
        }

        .highlight-box p {
            color: var(--text);
            margin: 0;
        }

        /* Tech Stack */
        .tech-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .tech-item {
            background: var(--bg);
            padding: 1.25rem;
            border-radius: 12px;
            text-align: center;
        }

        .tech-item .icon {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .tech-item h4 {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .tech-item p {
            font-size: 0.85rem;
            color: var(--text-light);
            margin: 0;
        }

        /* Process Steps */
        .process-steps {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            margin-top: 1.5rem;
        }

        .process-step {
            display: flex;
            gap: 1.5rem;
            align-items: flex-start;
        }

        .step-number {
            width: 50px;
            height: 50px;
            min-width: 50px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            font-weight: 700;
        }

        .step-content h4 {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .step-content p {
            margin: 0;
        }

        /* Demo Section */
        .demo-section {
            text-align: center;
            padding: 3rem 2rem;
            background: var(--white);
            border-radius: 16px;
            margin-bottom: 2rem;
        }

        .demo-section h2 {
            justify-content: center;
        }

        .demo-sites {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 0.75rem;
            margin-top: 1.5rem;
        }

        .demo-tag {
            background: var(--bg);
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            color: var(--text);
            font-weight: 500;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 1rem 2rem;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 10px;
            text-decoration: none;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            margin-top: 2rem;
            transition: all 0.3s;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(37,99,235,0.4);
        }

        /* Footer */
        footer {
            text-align: center;
            padding: 2rem;
            color: var(--text-light);
            border-top: 1px solid #e5e7eb;
        }

        footer a {
            color: var(--primary);
        }

        @media (max-width: 768px) {
            .hero h1 {
                font-size: 1.75rem;
            }
            .section {
                padding: 1.5rem;
            }
            .process-step {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="header-content">
            <a href="../index.php" class="logo"><span class="highlight">CAPTCHa</span>Star</a>
            <a href="../index.php" class="back-btn">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Back to Home
            </a>
        </div>
    </header>

    <section class="hero">
        <h1>How CAPTCHaStar Works</h1>
        <p>A semantic approach to CAPTCHA that connects brands with relevant content through intelligent matching</p>
    </section>

    <div class="content">
        <!-- What is CAPTCHaStar -->
        <div class="section">
            <h2><span class="icon">?</span> What is CAPTCHaStar?</h2>
            <p>
                CAPTCHaStar is an innovative <strong>Sponsored CAPTCHA</strong> system developed as a Bachelor's thesis
                project at Sapienza University of Rome. Unlike traditional CAPTCHAs that display random distorted text
                or generic images, CAPTCHaStar uses <strong>semantic analysis</strong> to match brand logos with the
                content of the webpage.
            </p>
            <div class="highlight-box">
                <p>
                    <strong>The key innovation:</strong> When a user visits a sports website, they see sports-related
                    brand logos (Nike, Adidas, NBA). On a tech site, they see tech brands (Apple, Google, Microsoft).
                    This creates a more relevant and engaging experience for both users and advertisers.
                </p>
            </div>
        </div>

        <!-- How the Matching Works -->
        <div class="section">
            <h2><span class="icon">AI</span> Semantic Matching Algorithm</h2>
            <p>
                The system uses Natural Language Processing (NLP) techniques to understand webpage content
                and find the most relevant brand logos:
            </p>
            <div class="process-steps">
                <div class="process-step">
                    <div class="step-number">1</div>
                    <div class="step-content">
                        <h4>Content Extraction</h4>
                        <p>The system extracts text content from the webpage, removing HTML tags, scripts, and common stopwords.</p>
                    </div>
                </div>
                <div class="process-step">
                    <div class="step-number">2</div>
                    <div class="step-content">
                        <h4>TF-IDF Keyword Analysis</h4>
                        <p>Using Term Frequency-Inverse Document Frequency, the system identifies the most important and distinctive keywords that define the page's topic.</p>
                    </div>
                </div>
                <div class="process-step">
                    <div class="step-number">3</div>
                    <div class="step-content">
                        <h4>Word Embeddings (GloVe)</h4>
                        <p>Keywords are converted to 100-dimensional vectors using GloVe word embeddings, capturing semantic meaning and relationships between words.</p>
                    </div>
                </div>
                <div class="process-step">
                    <div class="step-number">4</div>
                    <div class="step-content">
                        <h4>Cosine Similarity</h4>
                        <p>The page's semantic vector is compared with pre-computed vectors for 355+ brand logos across 15 categories. The most similar logos are selected.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- The CAPTCHA Challenge -->
        <div class="section">
            <h2><span class="icon">*</span> The Star Pattern Challenge</h2>
            <p>
                Once a relevant logo is selected, it's presented as an interactive challenge that's
                easy for humans but difficult for bots:
            </p>
            <ul>
                <li><strong>Dynamic Point Cloud:</strong> The logo is decomposed into white dots on a black canvas. These dots move based on the user's mouse position.</li>
                <li><strong>Pattern Recognition:</strong> Users must move their mouse to find the position where the dots align to form a recognizable shape (the brand logo).</li>
                <li><strong>Click to Verify:</strong> When the logo becomes visible, users click to verify. The system checks if the click position matches the solution coordinates.</li>
                <li><strong>Brand Reveal:</strong> Upon successful verification, the original brand logo is revealed, completing the sponsored experience.</li>
            </ul>
        </div>

        <!-- Technology Stack -->
        <div class="section">
            <h2><span class="icon">&#60;/&#62;</span> Technology Stack</h2>
            <p>CAPTCHaStar is built using the following technologies:</p>
            <div class="tech-grid">
                <div class="tech-item">
                    <div class="icon">PHP</div>
                    <h4>PHP 8+</h4>
                    <p>Backend logic & similarity calculations</p>
                </div>
                <div class="tech-item">
                    <div class="icon">MySQL</div>
                    <h4>MySQL</h4>
                    <p>Word vectors & logo keywords database</p>
                </div>
                <div class="tech-item">
                    <div class="icon">JS</div>
                    <h4>JavaScript</h4>
                    <p>Canvas rendering & mouse tracking</p>
                </div>
                <div class="tech-item">
                    <div class="icon">GloVe</div>
                    <h4>GloVe Embeddings</h4>
                    <p>100-dimensional word vectors</p>
                </div>
            </div>
        </div>

        <!-- Logo Database -->
        <div class="section">
            <h2><span class="icon">DB</span> Logo Database</h2>
            <p>
                The system includes a curated database of <strong>355+ brand logos</strong> organized
                into 15 thematic categories:
            </p>
            <ul>
                <li><strong>Sports:</strong> Nike, Adidas, Puma, NBA, UEFA, etc.</li>
                <li><strong>Auto & Moto:</strong> Ferrari, Mercedes, Toyota, Harley-Davidson, etc.</li>
                <li><strong>Technology:</strong> Apple, Google, Microsoft, Sony, Samsung, etc.</li>
                <li><strong>Fashion:</strong> Gucci, Louis Vuitton, Chanel, Armani, etc.</li>
                <li><strong>Food & Drinks:</strong> Coca-Cola, McDonald's, Starbucks, etc.</li>
                <li><strong>Music:</strong> Spotify, bands logos, record labels, etc.</li>
                <li><strong>Gaming:</strong> PlayStation, Xbox, Nintendo, etc.</li>
                <li><strong>Environment:</strong> WWF, Greenpeace, recycling symbols, etc.</li>
                <li>...and more categories including Beauty, Entertainment, Engineering, etc.</li>
            </ul>
            <p>
                Each logo has associated keywords extracted from Wikipedia articles, enabling
                accurate semantic matching with webpage content.
            </p>
        </div>

        <!-- Try the Demo -->
        <div class="demo-section">
            <h2><span class="icon">GO</span> Try It Yourself!</h2>
            <p style="color: var(--text-light); max-width: 500px; margin: 0 auto;">
                Experience CAPTCHaStar on our demo websites. Each site has themed content
                that will match with relevant brand logos.
            </p>
            <div class="demo-sites">
                <span class="demo-tag">Sports News</span>
                <span class="demo-tag">Gaming Hub</span>
                <span class="demo-tag">Auto Magazine</span>
                <span class="demo-tag">Music Blog</span>
                <span class="demo-tag">Food & Recipes</span>
                <span class="demo-tag">Fashion Weekly</span>
                <span class="demo-tag">Tech News</span>
                <span class="demo-tag">Beauty Tips</span>
                <span class="demo-tag">Environment</span>
                <span class="demo-tag">Entertainment</span>
            </div>
            <a href="random.php" class="btn">
                Launch Random Demo
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                </svg>
            </a>
        </div>

        <!-- Academic Context -->
        <div class="section">
            <h2><span class="icon">GRAD</span> Academic Context</h2>
            <p>
                This project was developed as part of a Bachelor's thesis in Computer Science at
                <strong>Sapienza University of Rome</strong>. The research explores the intersection
                of web security, natural language processing, and digital advertising.
            </p>
            <p>
                The goal was to create a CAPTCHA system that not only protects websites from bots
                but also provides value to advertisers through contextually relevant brand exposure,
                while maintaining a positive user experience.
            </p>
        </div>
    </div>

    <footer>
        <p>CAPTCHaStar - Bachelor Thesis Project | <a href="https://www.uniroma1.it" target="_blank">Sapienza University of Rome</a></p>
    </footer>
</body>
</html>
