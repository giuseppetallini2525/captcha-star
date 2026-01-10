<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAPTCHaStar - Semantic Sponsored CAPTCHA</title>
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
            --shadow: 0 10px 40px rgba(0,0,0,0.1);
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
            line-height: 1.6;
        }

        /* Hero Section */
        .hero {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 2rem;
            background: linear-gradient(135deg, var(--white) 0%, var(--bg) 100%);
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(37,99,235,0.05) 0%, transparent 70%);
            z-index: 0;
        }

        .hero-content {
            position: relative;
            z-index: 1;
            max-width: 800px;
        }

        .logo {
            font-size: 4rem;
            font-weight: 800;
            margin-bottom: 1rem;
        }

        .logo .highlight {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .tagline {
            font-size: 1.5rem;
            color: var(--text-light);
            margin-bottom: 2rem;
            font-weight: 500;
        }

        .description {
            font-size: 1.125rem;
            color: var(--text-light);
            margin-bottom: 3rem;
            max-width: 600px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 1rem 2.5rem;
            font-size: 1.125rem;
            font-weight: 600;
            border-radius: 0.75rem;
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
            border: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            box-shadow: 0 4px 15px rgba(37,99,235,0.4);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(37,99,235,0.5);
        }

        .btn-secondary {
            background: var(--white);
            color: var(--text);
            border: 2px solid var(--primary);
            margin-left: 1rem;
        }

        .btn-secondary:hover {
            background: var(--primary);
            color: white;
        }

        /* Features Section */
        .features {
            padding: 5rem 2rem;
            background: var(--white);
        }

        .features-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .section-subtitle {
            text-align: center;
            color: var(--text-light);
            font-size: 1.125rem;
            margin-bottom: 3rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .feature-card {
            background: var(--bg);
            padding: 2rem;
            border-radius: 1rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow);
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
        }

        .feature-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
        }

        .feature-text {
            color: var(--text-light);
        }

        /* How It Works */
        .how-it-works {
            padding: 5rem 2rem;
            background: var(--bg);
        }

        .steps {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 2rem;
            max-width: 1000px;
            margin: 0 auto;
        }

        .step {
            flex: 1;
            min-width: 250px;
            max-width: 300px;
            text-align: center;
        }

        .step-number {
            width: 50px;
            height: 50px;
            background: var(--primary);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0 auto 1rem;
        }

        .step-title {
            font-size: 1.125rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .step-text {
            color: var(--text-light);
            font-size: 0.95rem;
        }

        /* CTA Section */
        .cta {
            padding: 5rem 2rem;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            text-align: center;
            color: white;
        }

        .cta h2 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .cta p {
            font-size: 1.25rem;
            opacity: 0.9;
            margin-bottom: 2rem;
        }

        .btn-white {
            background: white;
            color: var(--primary);
            font-weight: 600;
        }

        .btn-white:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
        }

        /* Footer */
        footer {
            padding: 2rem;
            text-align: center;
            background: var(--text);
            color: white;
        }

        footer a {
            color: var(--primary);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .logo {
                font-size: 2.5rem;
            }
            .tagline {
                font-size: 1.25rem;
            }
            .btn {
                display: block;
                width: 100%;
                margin: 0.5rem 0;
            }
            .btn-secondary {
                margin-left: 0;
            }
            .section-title {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1 class="logo"><span class="highlight">CAPTCHa</span>Star</h1>
            <p class="tagline">Semantic Sponsored CAPTCHA System</p>
            <p class="description">
                A novel approach to CAPTCHA that combines brand recognition with semantic web analysis.
                The system matches contextually relevant logos to website content, creating an engaging
                and intelligent human verification experience.
            </p>
            <div>
                <a href="pages/random.php" class="btn btn-primary">
                    <span>Try Demo</span>
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </a>
                <a href="pages/about.php" class="btn btn-secondary">Learn More</a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="features-container">
            <h2 class="section-title">Why CAPTCHaStar?</h2>
            <p class="section-subtitle">
                A smarter CAPTCHA that understands context and delivers relevant brand experiences
            </p>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">🧠</div>
                    <h3 class="feature-title">Semantic Analysis</h3>
                    <p class="feature-text">
                        Uses NLP and word embeddings (GloVe) to understand page content and match
                        semantically relevant logos based on TF-IDF weighted keywords.
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🎯</div>
                    <h3 class="feature-title">Contextual Matching</h3>
                    <p class="feature-text">
                        Displays brand logos that are contextually relevant to the website content,
                        creating a more natural and engaging user experience.
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🔒</div>
                    <h3 class="feature-title">Bot Protection</h3>
                    <p class="feature-text">
                        Interactive star-pattern recognition challenge that's easy for humans
                        but difficult for automated programs to solve.
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📊</div>
                    <h3 class="feature-title">Brand Visibility</h3>
                    <p class="feature-text">
                        Sponsors gain targeted exposure to users browsing relevant content,
                        with 355+ logos across 15 different categories.
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">⚡</div>
                    <h3 class="feature-title">Fast & Lightweight</h3>
                    <p class="feature-text">
                        Optimized similarity calculation using cosine similarity on
                        100-dimensional word vectors for quick response times.
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📱</div>
                    <h3 class="feature-title">Mobile Friendly</h3>
                    <p class="feature-text">
                        Touch-enabled interface works seamlessly on mobile devices
                        with intuitive drag-and-tap controls.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="how-it-works">
        <div class="features-container">
            <h2 class="section-title">How It Works</h2>
            <p class="section-subtitle">
                Three simple steps to verify you're human while seeing relevant brands
            </p>
            <div class="steps">
                <div class="step">
                    <div class="step-number">1</div>
                    <h3 class="step-title">Visit a Website</h3>
                    <p class="step-text">
                        Browse any webpage - the system analyzes the content to understand the topic and context.
                    </p>
                </div>
                <div class="step">
                    <div class="step-number">2</div>
                    <h3 class="step-title">Solve the CAPTCHA</h3>
                    <p class="step-text">
                        Move your mouse to reveal a hidden logo pattern. Click when you recognize the shape.
                    </p>
                </div>
                <div class="step">
                    <div class="step-number">3</div>
                    <h3 class="step-title">See Relevant Brands</h3>
                    <p class="step-text">
                        Upon success, discover a brand logo that matches the website's content category.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <h2>Ready to Try It?</h2>
        <p>Experience the next generation of CAPTCHA technology</p>
        <a href="pages/random.php" class="btn btn-white">
            Launch Demo
            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="margin-left:0.5rem;">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
            </svg>
        </a>
    </section>

    <!-- Footer -->
    <footer>
        <p>CAPTCHaStar - Bachelor Thesis Project | <a href="https://www.uniroma1.it" target="_blank">Sapienza University of Rome</a></p>
    </footer>
</body>
</html>
