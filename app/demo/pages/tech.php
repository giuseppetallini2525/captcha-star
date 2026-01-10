<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechNews - Technology, Gadgets, Software & Innovation</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="modal.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #f0f4f8; color: #1a202c; }
        header { background: #1a202c; color: white; }
        .nav-container { display: flex; justify-content: space-between; align-items: center; max-width: 1400px; margin: 0 auto; padding: 1rem 2rem; }
        .logo { font-size: 1.8rem; font-weight: 800; }
        .logo span { color: #3b82f6; }
        nav a { color: #94a3b8; text-decoration: none; margin-left: 2rem; font-weight: 500; }
        nav a:hover { color: white; }
        .btn-login { background: #3b82f6; color: white; padding: 0.6rem 1.5rem; border-radius: 6px; text-decoration: none; font-weight: 600; cursor: pointer; }
        .hero { background: linear-gradient(135deg, #1e3a5f, #1a202c); padding: 4rem 2rem; }
        .hero-content { max-width: 1200px; margin: 0 auto; color: white; }
        .hero-tag { background: #3b82f6; display: inline-block; padding: 0.3rem 1rem; font-size: 0.75rem; font-weight: 600; border-radius: 4px; margin-bottom: 1rem; }
        .hero h1 { font-size: 2.5rem; margin-bottom: 1rem; max-width: 800px; }
        .hero p { color: #94a3b8; font-size: 1.1rem; }
        .container { max-width: 1200px; margin: 0 auto; padding: 3rem 2rem; }
        .content-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 2rem; }
        .section-title { font-size: 1.5rem; font-weight: 700; margin-bottom: 1.5rem; color: #1e3a5f; border-bottom: 3px solid #3b82f6; padding-bottom: 0.5rem; display: inline-block; }
        .article-card { background: white; border-radius: 12px; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .article-meta { color: #3b82f6; font-size: 0.8rem; font-weight: 600; margin-bottom: 0.5rem; }
        .article-title { font-size: 1.1rem; font-weight: 600; margin-bottom: 0.75rem; color: #1a202c; }
        .article-text { color: #64748b; font-size: 0.95rem; line-height: 1.8; }
        .sidebar-box { background: white; border-radius: 12px; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .sidebar-title { font-size: 1rem; font-weight: 700; color: #1e3a5f; margin-bottom: 1rem; padding-bottom: 0.5rem; border-bottom: 2px solid #3b82f6; }
        .cta-box { background: linear-gradient(135deg, #3b82f6, #1d4ed8); color: white; text-align: center; padding: 2rem; }
        .cta-btn { display: inline-block; background: white; color: #3b82f6; padding: 0.75rem 2rem; border-radius: 6px; text-decoration: none; font-weight: 600; cursor: pointer; }
        footer { background: #1a202c; color: white; padding: 2rem; text-align: center; margin-top: 3rem; }
        footer a { color: #3b82f6; }
        @media (max-width: 900px) { .content-grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
    <header>
        <div class="nav-container">
            <div class="logo">Tech<span>News</span></div>
            <nav>
                <a href="#">Gadgets</a>
                <a href="#">Software</a>
                <a href="#">AI</a>
                <a href="#">Mobile</a>
                <a href="#">Reviews</a>
            </nav>
            <a href="#" onclick="openCaptchaModal(); return false;" class="btn-login">Accedi</a>
        </div>
    </header>

    <section class="hero">
        <div class="hero-content">
            <span class="hero-tag">BREAKING NEWS</span>
            <h1>Apple Announces Revolutionary iPhone 18 with AI-Powered Features</h1>
            <p>The latest smartphone from Apple features groundbreaking artificial intelligence capabilities</p>
        </div>
    </section>

    <div class="container">
        <div class="content-grid">
            <main>
                <h2 class="section-title">Technology News & Product Reviews</h2>

                <article class="article-card">
                    <div class="article-meta">SMARTPHONES - APPLE</div>
                    <h3 class="article-title">Apple iPhone 18 Review: Revolutionary Camera System and AI Integration</h3>
                    <p class="article-text">
                        Apple has unveiled the iPhone 18, featuring the most advanced smartphone camera system ever developed and deep integration with artificial intelligence. The new iPhone runs on Apple's latest A20 chip, delivering unprecedented performance for mobile computing and photography. iOS continues to evolve with enhanced features for productivity, privacy, and seamless integration with Mac computers and iPad tablets. The smartphone includes satellite connectivity, improved battery life, and a stunning OLED display. Apple's technology innovations have consistently shaped the mobile phone industry, and the iPhone remains the benchmark for premium smartphones. Samsung and Google compete aggressively in the Android smartphone market with their Galaxy and Pixel devices. Mobile phone technology continues to advance rapidly with 5G connectivity, advanced cameras, and powerful processors becoming standard features.
                    </p>
                </article>

                <article class="article-card">
                    <div class="article-meta">COMPUTERS - MICROSOFT</div>
                    <h3 class="article-title">Microsoft Launches Windows 12 with Integrated AI Assistant</h3>
                    <p class="article-text">
                        Microsoft has released Windows 12, the latest version of its operating system featuring an AI-powered assistant that transforms how users interact with their computers. The software giant integrates advanced artificial intelligence throughout the Windows experience, from file organization to creative tasks. Microsoft Office applications receive significant updates with AI-powered writing and analysis tools. The technology company continues to compete with Apple in the personal computer market while expanding its cloud computing services through Azure. Dell, HP, and Lenovo are releasing new laptops and desktop computers optimized for Windows 12. Gaming performance improvements benefit Xbox Game Pass integration on PC platforms. Microsoft's software development tools and programming languages remain essential for technology professionals worldwide.
                    </p>
                </article>

                <article class="article-card">
                    <div class="article-meta">SOCIAL MEDIA - PLATFORMS</div>
                    <h3 class="article-title">Instagram and TikTok Battle for Creator Economy Dominance</h3>
                    <p class="article-text">
                        The social media landscape continues to evolve as Instagram and TikTok compete for content creators and advertising revenue. Meta's Instagram platform has introduced new features to rival TikTok's short-form video dominance and attract younger users. Facebook remains a significant platform for social networking and digital advertising, while WhatsApp leads in messaging applications. Twitter, now rebranded, continues to evolve its social media offerings. YouTube maintains its position as the leading video platform for long-form content and creator monetization. Social media companies are investing heavily in AI-powered content recommendation algorithms. The technology industry recognizes social platforms as essential for digital marketing, communication, and entertainment. Influencer marketing and content creation have become significant economic sectors within the digital ecosystem.
                    </p>
                </article>

                <article class="article-card">
                    <div class="article-meta">AUDIO - HEADPHONES</div>
                    <h3 class="article-title">Sony and Bose Release Next-Generation Noise-Canceling Headphones</h3>
                    <p class="article-text">
                        Premium audio technology reaches new heights as Sony and Bose unveil their latest noise-canceling headphones with advanced features. Sony's headphones deliver exceptional sound quality with industry-leading noise cancellation and extended battery life for wireless listening. Bose continues to refine its audio technology with comfortable designs and premium sound reproduction. Apple's AirPods and Beats headphones compete in the wireless audio market with seamless iPhone integration. JBL and Sennheiser also offer high-quality audio products for music enthusiasts and professionals. Bluetooth technology enables convenient wireless connectivity across all headphone categories. The audio equipment industry continues to innovate with spatial audio, personalized sound profiles, and improved active noise cancellation. Music streaming services like Spotify and Apple Music drive demand for premium listening equipment.
                    </p>
                </article>

                <article class="article-card">
                    <div class="article-meta">ARTIFICIAL INTELLIGENCE - INNOVATION</div>
                    <h3 class="article-title">AI Revolution: How Artificial Intelligence is Transforming Every Industry</h3>
                    <p class="article-text">
                        Artificial intelligence continues to reshape technology and business across all sectors. Google, Microsoft, and OpenAI lead the development of large language models and AI-powered applications. Machine learning algorithms are improving search engines, recommendation systems, and automation tools. Technology companies are integrating AI into smartphones, computers, and cloud services. IBM and Intel are developing specialized AI hardware to accelerate machine learning workloads. The software industry is being transformed by AI-powered coding assistants and development tools. Companies are adopting AI technology for customer service, data analysis, and creative applications. The technology sector sees artificial intelligence as the most significant innovation since the internet, driving investment and research worldwide.
                    </p>
                </article>
            </main>

            <aside>
                <div class="sidebar-box cta-box">
                    <h3 style="color: white; margin-bottom: 0.75rem;">Join TechNews</h3>
                    <p style="color: rgba(255,255,255,0.9); margin-bottom: 1rem;">Get the latest tech reviews and product launches</p>
                    <a href="#" onclick="openCaptchaModal(); return false;" class="cta-btn">Accedi</a>
                </div>

                <div class="sidebar-box">
                    <h4 class="sidebar-title">Tech Companies</h4>
                    <p style="color: #666; font-size: 0.9rem; line-height: 1.6;">
                        Apple, Microsoft, Google, Samsung, Sony, Intel, IBM, Dell, HP, Lenovo, Huawei, LG, Motorola, Nokia, Asus, Acer, NVIDIA, AMD, Qualcomm, Cisco, Oracle, Adobe, Salesforce, technology companies, software developers, hardware manufacturers, computer industry, electronics, gadgets, devices.
                    </p>
                </div>

                <div class="sidebar-box">
                    <h4 class="sidebar-title">Digital Platforms</h4>
                    <p style="color: #666; font-size: 0.9rem; line-height: 1.6;">
                        Facebook, Instagram, Twitter, TikTok, YouTube, WhatsApp, Snapchat, LinkedIn, Spotify, Netflix, Amazon, eBay, Alibaba, social media, streaming services, e-commerce, cloud computing, mobile apps, software applications, digital services, internet platforms, online technology.
                    </p>
                </div>
            </aside>
        </div>
    </div>

    <footer>
        <p>TechNews - Demo for <a href="../../index.php">CAPTCHaStar</a> | Sapienza University of Rome</p>
    </footer>

<!-- CAPTCHA Modal -->
<div id="captchaModal" class="captcha-modal-overlay" onclick="closeCaptchaModal(event)">
    <div class="captcha-modal" onclick="event.stopPropagation()">
        <div class="captcha-modal-header">
            <h3>Sponsored CAPTCHA</h3>
            <button class="captcha-modal-close" onclick="closeCaptchaModal()">&times;</button>
        </div>
        <div class="captcha-modal-body">
            <iframe id="captchaFrame" src=""></iframe>
        </div>
    </div>
</div>

<script>
    function openCaptchaModal() {
        var modal = document.getElementById('captchaModal');
        var iframe = document.getElementById('captchaFrame');
        var currentUrl = window.location.href;
        iframe.src = 'captcha-modal.php?from=' + encodeURIComponent(currentUrl);
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeCaptchaModal(event) {
        if (event && event.target !== event.currentTarget) return;
        var modal = document.getElementById('captchaModal');
        var iframe = document.getElementById('captchaFrame');
        modal.classList.remove('active');
        iframe.src = '';
        document.body.style.overflow = '';
    }

    window.addEventListener('message', function(event) {
        if (event.data && event.data.type === 'captcha-success') {
            console.log('CAPTCHA solved successfully!');
        }
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeCaptchaModal();
        }
    });
</script>
</body>
</html>
