<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoWorld - Environment, Sustainability & Green Living</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="modal.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #f0fdf4; color: #1a1a1a; }
        header { background: #065f46; color: white; }
        .nav-container { display: flex; justify-content: space-between; align-items: center; max-width: 1400px; margin: 0 auto; padding: 1rem 2rem; }
        .logo { font-size: 1.8rem; font-weight: 800; }
        .logo span { color: #86efac; }
        nav a { color: #a7f3d0; text-decoration: none; margin-left: 2rem; font-weight: 500; }
        nav a:hover { color: white; }
        .btn-login { background: #86efac; color: #065f46; padding: 0.6rem 1.5rem; border-radius: 25px; text-decoration: none; font-weight: 600; cursor: pointer; }
        .hero { background: linear-gradient(135deg, #065f46, #047857); padding: 4rem 2rem; color: white; text-align: center; }
        .hero h1 { font-size: 2.5rem; margin-bottom: 1rem; }
        .hero p { color: #a7f3d0; font-size: 1.2rem; }
        .container { max-width: 1200px; margin: 0 auto; padding: 3rem 2rem; }
        .content-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 2rem; }
        .section-title { font-size: 1.5rem; font-weight: 700; color: #065f46; margin-bottom: 1.5rem; border-bottom: 3px solid #10b981; padding-bottom: 0.5rem; display: inline-block; }
        .article-card { background: white; border-radius: 16px; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 4px 15px rgba(6,95,70,0.08); border-left: 4px solid #10b981; }
        .article-meta { color: #10b981; font-size: 0.8rem; font-weight: 600; margin-bottom: 0.5rem; }
        .article-title { font-size: 1.1rem; font-weight: 600; margin-bottom: 0.75rem; color: #1f2937; }
        .article-text { color: #4b5563; font-size: 0.95rem; line-height: 1.85; }
        .sidebar-box { background: white; border-radius: 16px; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 4px 15px rgba(6,95,70,0.08); }
        .sidebar-title { font-size: 1rem; font-weight: 700; color: #065f46; margin-bottom: 1rem; padding-bottom: 0.5rem; border-bottom: 2px solid #10b981; }
        .cta-box { background: linear-gradient(135deg, #10b981, #059669); color: white; text-align: center; padding: 2rem; }
        .cta-btn { display: inline-block; background: white; color: #059669; padding: 0.75rem 2rem; border-radius: 25px; text-decoration: none; font-weight: 600; cursor: pointer; }
        footer { background: #065f46; color: white; padding: 2rem; text-align: center; margin-top: 3rem; }
        footer a { color: #86efac; }
        @media (max-width: 900px) { .content-grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
    <header>
        <div class="nav-container">
            <div class="logo">Eco<span>World</span></div>
            <nav>
                <a href="#">Climate</a>
                <a href="#">Wildlife</a>
                <a href="#">Oceans</a>
                <a href="#">Energy</a>
                <a href="#">Recycling</a>
            </nav>
            <a href="#" onclick="openCaptchaModal(); return false;" class="btn-login">Accedi</a>
        </div>
    </header>

    <section class="hero">
        <h1>Protecting Our Planet Together</h1>
        <p>News and insights on environmental conservation and sustainable living</p>
    </section>

    <div class="container">
        <div class="content-grid">
            <main>
                <h2 class="section-title">Environmental News & Conservation</h2>

                <article class="article-card">
                    <div class="article-meta">WILDLIFE - CONSERVATION</div>
                    <h3 class="article-title">WWF Reports Progress in Global Wildlife Protection Efforts</h3>
                    <p class="article-text">
                        The World Wildlife Fund has released its annual report showing significant progress in wildlife conservation efforts worldwide. WWF's conservation programs have helped protect endangered species including pandas, tigers, elephants, and marine life across multiple continents. Environmental organizations are working to preserve natural habitats and combat the threats of climate change and deforestation. The famous panda logo of WWF has become synonymous with global conservation efforts and environmental awareness. Wildlife sanctuaries and national parks play crucial roles in protecting biodiversity and ecosystem health. Conservation scientists are using advanced technology to monitor animal populations and track migration patterns. The environmental movement continues to grow as more people recognize the importance of protecting nature and wildlife for future generations.
                    </p>
                </article>

                <article class="article-card">
                    <div class="article-meta">OCEANS - MARINE PROTECTION</div>
                    <h3 class="article-title">Greenpeace Launches Campaign to Protect Ocean Ecosystems</h3>
                    <p class="article-text">
                        Greenpeace has initiated a major campaign to protect marine ecosystems from pollution, overfishing, and climate change impacts. The environmental organization is calling for expanded marine protected areas and sustainable fishing practices. Ocean conservation efforts focus on reducing plastic pollution and protecting coral reefs from warming waters. Sea Shepherd and other marine conservation groups are actively patrolling oceans to prevent illegal fishing activities. The environmental movement emphasizes the critical role oceans play in regulating global climate and supporting biodiversity. Marine biologists are documenting the effects of pollution on whale, dolphin, and sea turtle populations. Environmental activists are raising awareness about the interconnection between ocean health and human well-being through education and advocacy campaigns.
                    </p>
                </article>

                <article class="article-card">
                    <div class="article-meta">RECYCLING - SUSTAINABILITY</div>
                    <h3 class="article-title">Global Recycling Initiative Transforms Waste Management Practices</h3>
                    <p class="article-text">
                        A new global recycling initiative is revolutionizing how communities manage waste and promote sustainable living. Recycling programs are expanding to include more materials, from plastic and paper to electronics and organic waste. Environmental agencies are implementing circular economy principles to reduce landfill usage and conserve natural resources. The recycling symbol has become universally recognized as a call to action for environmental responsibility. Municipalities are investing in advanced sorting facilities and composting programs. Sustainable packaging innovations help reduce the environmental footprint of consumer products. Corporate sustainability programs are setting ambitious targets for waste reduction and recycled material usage. The environmental benefits of recycling include reduced greenhouse gas emissions and conservation of raw materials.
                    </p>
                </article>

                <article class="article-card">
                    <div class="article-meta">CLIMATE - RENEWABLE ENERGY</div>
                    <h3 class="article-title">UNESCO World Heritage Sites Face Climate Change Threats</h3>
                    <p class="article-text">
                        UNESCO has issued warnings about climate change impacts on World Heritage Sites across the globe. Rising temperatures, extreme weather events, and sea level rise threaten historical monuments and natural wonders. Environmental scientists are working with UNESCO to develop protection strategies for vulnerable sites. The tree of life concept symbolizes the interconnection of all living things and the importance of environmental stewardship. National parks and protected areas are implementing climate adaptation measures to preserve biodiversity. Environmental education programs emphasize the relationship between human activities and climate change. International cooperation is essential for addressing global environmental challenges and protecting our natural and cultural heritage. Sustainable tourism practices help minimize the environmental impact on sensitive ecosystems.
                    </p>
                </article>

                <article class="article-card">
                    <div class="article-meta">FORESTS - CONSERVATION</div>
                    <h3 class="article-title">Reforestation Projects Plant Millions of Trees Worldwide</h3>
                    <p class="article-text">
                        Major reforestation initiatives are transforming deforested areas into thriving forests, absorbing carbon dioxide and restoring ecosystems. Environmental organizations like Legambiente and local conservation groups are leading tree-planting campaigns. Forests play vital roles in climate regulation, water purification, and habitat provision for countless species. Sustainable forestry practices balance timber production with environmental protection. Environmental activists are fighting deforestation in tropical rainforests, which contain the majority of Earth's biodiversity. The leaf symbol represents growth, renewal, and our connection to nature. Corporate sustainability initiatives are funding reforestation projects as part of carbon offset programs. Community-based conservation efforts empower local populations to protect and restore their natural environments.
                    </p>
                </article>
            </main>

            <aside>
                <div class="sidebar-box cta-box">
                    <h3 style="color: white; margin-bottom: 0.75rem;">Join EcoWorld</h3>
                    <p style="color: rgba(255,255,255,0.9); margin-bottom: 1rem;">Get environmental news and conservation updates</p>
                    <a href="#" onclick="openCaptchaModal(); return false;" class="cta-btn">Accedi</a>
                </div>

                <div class="sidebar-box">
                    <h4 class="sidebar-title">Environmental Organizations</h4>
                    <p style="color: #666; font-size: 0.9rem; line-height: 1.7;">
                        WWF, World Wildlife Fund, Greenpeace, Sea Shepherd, PETA, Legambiente, UNESCO, UNDP, environmental protection, wildlife conservation, marine conservation, forest preservation, climate action, sustainability, ecological organizations, nature conservation, animal welfare, ocean protection, environmental activism.
                    </p>
                </div>

                <div class="sidebar-box">
                    <h4 class="sidebar-title">Environmental Topics</h4>
                    <p style="color: #666; font-size: 0.9rem; line-height: 1.7;">
                        Climate change, global warming, renewable energy, solar power, wind energy, recycling, waste management, pollution, deforestation, biodiversity, endangered species, ecosystem, carbon footprint, sustainable living, green technology, eco-friendly products, organic, natural, environmental protection, conservation, ecology.
                    </p>
                </div>
            </aside>
        </div>
    </div>

    <footer>
        <p>EcoWorld - Demo for <a href="../../index.php">CAPTCHaStar</a> | Sapienza University of Rome</p>
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
