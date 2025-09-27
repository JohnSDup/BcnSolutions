<?php

include 'db.php';
$ip = $_SERVER['REMOTE_ADDR'];
$user_agent = $_SERVER['HTTP_USER_AGENT'];
$path = $_SERVER['REQUEST_URI'];


$geo = json_decode(file_get_contents("http://ip-api.com/json/$ip"));
$country = $geo->country ?? '';
$city = $geo->city ?? '';


$stmt = $pdo->prepare("INSERT INTO pageviews (path, ip, country, city, user_agent) VALUES (?, ?, ?, ?, ?)");
$stmt->execute([$path, $ip, $country, $city, $user_agent]);
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BcnSolutions - Tu partner en datos urbanos</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- Header / Navigation -->
<!-- Header / Navigation -->
<header class="top-header">
    <div class="container">
        <div class="header-content">
            <div class="header-left">
                <img src="logo.png" alt="BcnSolutions" class="logo">
            </div>
            <nav class="header-right">
                <ul class="main-nav">
                    <li><a href="#products">Productos</a></li>
                    <li><a href="#solutions">Soluciones</a></li>
                    <li><a href="#about">Sobre Nosotros</a></li>
                    <li><a href="#demo">Demo</a></li>
                    <li><a href="login.php" class="login-btn">Login</a></li>
                </ul>
                <div class="mobile-menu-toggle">
                    <i class="fas fa-bars"></i>
                </div>
            </nav>
        </div>
    </div>
</header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-background">
            <div class="map-overlay"></div>
        </div>
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title">Soluciones Inteligentes para Ciudades del Futuro</h1>
                <p class="hero-subtitle">Transformamos datos urbanos en decisiones estratégicas para mejorar la calidad de vida en las ciudades.</p>
                <div class="hero-actions">
                    <a href="#demo" class="btn btn-primary">Programar Demo</a>
                    <a href="#products" class="btn btn-secondary">Ver Productos</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section id="products" class="products-section">
        <div class="container">
            <div class="section-header">
                <h2>Nuestros Productos</h2>
                <p>Soluciones diseñadas para abordar los desafíos urbanos más complejos</p>
            </div>
            <div class="product-grid">
                <div class="product-card">
                    <div class="product-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3>Analytics Platform</h3>
                    <p>Plataforma integral de análisis de datos urbanos con visualizaciones interactivas y dashboards personalizables.</p>
                    <a href="products/producto1.php" class="product-link">Explorar <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="product-card">
                    <div class="product-icon">
                        <i class="fas fa-traffic-light"></i>
                    </div>
                    <h3>Mobility Insights</h3>
                    <p>Sistema de monitorización de movilidad urbana con predicciones de tráfico y optimización de rutas.</p>
                    <a href="products/producto2.php" class="product-link">Explorar <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="product-card">
                    <div class="product-icon">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <h3>Sustainability Dashboard</h3>
                    <p>Monitorización de indicadores de sostenibilidad y huella ambiental para políticas urbanas más verdes.</p>
                    <a href="products/producto3.php" class="product-link">Explorar <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </section>

    <!-- Demo Section -->
    <section id="demo" class="demo-section">
        <div class="container">
            <div class="demo-content">
                <div class="demo-text">
                    <h2>Descubre cómo podemos transformar tu ciudad</h2>
                    <p>Nuestro prototipo personalizado muestra exactamente cómo nuestras soluciones se adaptan a las necesidades específicas de tu municipio.</p>
                    <ul class="demo-features">
                        <li><i class="fas fa-check"></i> Análisis personalizado de datos</li>
                        <li><i class="fas fa-check"></i> Dashboard interactivo</li>
                        <li><i class="fas fa-check"></i> Reportes automatizados</li>
                    </ul>
                    <a href="#" class="btn btn-primary" id="demo-btn">Solicitar Demo Personalizada</a>
                </div>
                <div class="demo-visual">
                    <div class="demo-placeholder">
                        <i class="fas fa-chart-bar"></i>
                        <p>Vista previa interactiva del producto</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about-section">
        <div class="container">
            <div class="about-content">
                <div class="about-text">
                    <h2>Impulsando Ciudades Inteligentes</h2>
                    <p>En BcnSolutions combinamos experiencia en análisis de datos urbanos con tecnología de vanguardia para ayudar a las ciudades a tomar decisiones más informadas.</p>
                    <p>Nuestro equipo multidisciplinario trabaja con administraciones públicas para desarrollar soluciones que mejoren la eficiencia de los servicios urbanos y la calidad de vida de los ciudadanos.</p>
                    <div class="stats">
                        <div class="stat">
                            <span class="stat-number">50+</span>
                            <span class="stat-label">Proyectos Completados</span>
                        </div>
                        <div class="stat">
                            <span class="stat-number">15</span>
                            <span class="stat-label">Ciudades Atendidas</span>
                        </div>
                        <div class="stat">
                            <span class="stat-number">98%</span>
                            <span class="stat-label">Satisfacción del Cliente</span>
                        </div>
                    </div>
                </div>
                <div class="about-image">
                    <div class="image-placeholder">
                        <i class="fas fa-city"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter / Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-newsletter">
                    <h3>Mantente Informado</h3>
                    <p>Suscríbete a nuestro newsletter para recibir las últimas novedades en soluciones urbanas inteligentes.</p>
                    <form class="newsletter-form" id="newsletter-form" action="save_email.php" method="post">
                        <div class="form-group">
                            <input type="email" name="email" placeholder="tu@correo.com" required>
                            <button type="submit" class="btn btn-primary">Suscribirme</button>
                        </div>
                        <div class="form-message" id="form-message"></div>
                    </form>
                </div>
                <div class="footer-links">
                    <div class="footer-column">
                        <h4>Productos</h4>
                        <ul>
                            <li><a href="products/producto1.php">Analytics Platform</a></li>
                            <li><a href="products/producto2.php">Mobility Insights</a></li>
                            <li><a href="products/producto3.php">Sustainability Dashboard</a></li>
                        </ul>
                    </div>
                    <div class="footer-column">
                        <h4>Empresa</h4>
                        <ul>
                            <li><a href="#about">Sobre Nosotros</a></li>
                            <li><a href="#contact">Contacto</a></li>
                            <li><a href="#">Blog</a></li>
                        </ul>
                    </div>
                    <div class="footer-column">
                        <h4>Recursos</h4>
                        <ul>
                            <li><a href="http://app.ourcityindata.com" target="_blank">Webapp</a></li>
                            <li><a href="#">Documentación</a></li>
                            <li><a href="#">Casos de Estudio</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 BcnSolutions. Todos los derechos reservados.</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-linkedin"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button id="back-to-top" class="back-to-top">
        <i class="fas fa-chevron-up"></i>
    </button>

    <!-- JavaScript Files -->
    <script src="js/script.js"></script>
    
    <!-- Additional tracking script -->
    <script>
        // Enhanced tracking for user interactions
        document.addEventListener('DOMContentLoaded', function() {
            // Track button clicks
            document.querySelectorAll('.btn, .product-link, .main-nav a').forEach(button => {
                button.addEventListener('click', function(e) {
                    const buttonText = this.textContent.trim();
                    const buttonHref = this.getAttribute('href') || '#';
                    
                    // Send tracking data to your backend
                    fetch('track_interaction.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            action: 'button_click',
                            label: buttonText,
                            target: buttonHref,
                            page: '<?php echo $path; ?>'
                        })
                    });
                });
            });
            
            // Track form submissions
            const newsletterForm = document.getElementById('newsletter-form');
            if (newsletterForm) {
                newsletterForm.addEventListener('submit', function() {
                    fetch('track_interaction.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            action: 'newsletter_signup',
                            page: '<?php echo $path; ?>'
                        })
                    });
                });
            }
            
            // Track scroll depth
            let maxScroll = 0;
            window.addEventListener('scroll', function() {
                const currentScroll = (window.scrollY / document.body.scrollHeight) * 100;
                if (currentScroll > maxScroll) {
                    maxScroll = currentScroll;
                    
                    // Send scroll tracking at certain intervals
                    if (maxScroll % 25 === 0) {
                        fetch('track_interaction.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                                action: 'scroll_depth',
                                depth: Math.round(maxScroll),
                                page: '<?php echo $path; ?>'
                            })
                        });
                    }
                }
            });
        });
    </script>
</body>
</html>