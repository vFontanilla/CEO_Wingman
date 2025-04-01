<?php
/**
 * Plugin Name: Hover Reveal Shortcode 2
 * Description: A shortcode to create a hover-to-reveal grid effect for speakers.
 * Version: 2.0
 * Author: Wingman Group
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

// Register Shortcode
function hover_reveal_shortcode2() {
    ob_start();
    ?>
    <style>
        @font-face {
            font-family: 'Gotham';
            src: url('../fonts/Gotham.woff2') format('woff2'),
                url('../fonts/Gotham.woff') format('woff'),
                url('../fonts/Gotham.ttf') format('truetype');
            font-weight: normal !important;
            font-style: normal !important;
        }

        .hover-reveal-parentcontainer .hover-reveal-grid {
            display: grid !important;  
            grid-template-columns: repeat(3, 1fr) !important;
            align-items: stretch !important;
            justify-content: center !important;
            gap: 20px !important;
            grid-auto-flow: row !important;
            height: 100% !important;
        }
        .hover-reveal-parentcontainer .hover-reveal-grid > .grid-item:nth-last-child(1):nth-child(3n + 1) {
            grid-column: 2 !important; /* 🔹 Moves the single item to the 2nd column */
        }

        .hover-reveal-parentcontainer .grid-item {
            position: relative !important;
        }
        
        .hover-reveal-parentcontainer .grid-item img {
            object-fit: cover !important;
            width: 100% !important;
            height: auto !important;
        }
        @media (max-width: 768px) {
            .hover-reveal-parentcontainer .hover-reveal-grid {
                display: grid !important;
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)) !important;
                gap: 15px !important;
            }

            .hover-reveal-parentcontainer .grid-item {
                min-width: 150px !important;
            }

            .hover-reveal-parentcontainer .hover-reveal-grid > .grid-item:nth-child(odd):last-child {
                grid-column: span 2 !important;
                justify-self: center !important;
                width: 50% !important;
            }

            .hover-reveal-parentcontainer .popup-container {
                width: 100% !important;
                padding: 15px !important;
                border: 2px solid #FFAE00 !important;
                height: 100% !important;
            }

            .hover-reveal-parentcontainer .popup-container h3 {
                color: #FFAE00 !important;
                font-family: 'Gotham', sans-serif !important;
                font-weight: 600 !important;
                margin-bottom: 10px !important;
                font-size: 14px !important;
            }

            .hover-reveal-parentcontainer .popup-container h2 {
                color: #FFAE00 !important;
                font-family: 'Gotham', sans-serif !important;
                font-weight: 600 !important;
                margin-bottom: 10px !important;
                font-size: 14px !important;
            }

            .hover-reveal-parentcontainer .popup-container p {
                color: #FFFFFF !important;
                font-family: 'Gotham', sans-serif !important;
                font-weight: 600 !important;
                margin-bottom: 10px !important;
                font-size: 14px !important;
                overflow-y: auto !important;
                text-align: left !important;
                padding-right: 10px !important;
            }

            .hover-reveal-parentcontainer .close-button {
                font-size: 18px !important; /* Smaller size for mobile screens */
                padding: 4px 8px !important; /* Adjust padding for smaller screens */
            }
        }

        .hover-reveal-parentcontainer .grid-item h2 {
            color: #FFAE00 !important;
            text-align: center !important;
            font-family: 'Gotham', sans-serif !important;
            font-weight: 600 !important;
            font-style: normal !important;
            padding-top: 020px !important;
            margin-bottom: 0 !important;
            font-size: 18px !important;
        }
        .hover-reveal-parentcontainer .grid-item p {
            color: #FFFFFF !important;
            text-align: center !important;
            font-family: 'Gotham', sans-serif !important;
            font-weight: 400 !important;
            font-style: normal !important;
            margin-top: 0 !important;
        }
        .hover-reveal-parentcontainer .popup-container {
            visibility: hidden !important;
            position: absolute !important;
            top: 0 !important;
            left: 0 !important;
            width: 100% !important;
            height: 100% !important;
            background-color: rgba(0, 0, 0, 0.9) !important;
            padding: 20px !important;
            text-align: center !important;
            color: white !important;
            z-index: 1000 !important;
            transition: opacity 0.3s ease, transform 0.3s ease, visibility 0.3s ease !important;
            opacity: 0 !important;
            display: flex !important;
            flex-direction: column !important;
            justify-content: center !important;
            align-items: center !important;
            border: 2px solid #FFAE00 !important;
        }
        .hover-reveal-parentcontainer .popup-container h2 {
            color: #FFAE00 !important;
            font-family: 'Gotham', sans-serif !important;
            font-weight: 600 !important;
            margin-bottom: 10px !important;
            font-size: 18px !important;
        }
        .hover-reveal-parentcontainer .popup-container h3 {
            color: #FFAE00 !important;
            font-family: 'Gotham', sans-serif !important;
            font-weight: 600 !important;
            margin-bottom: 10px !important;
            font-size: 20px !important;
        }
        .hover-reveal-parentcontainer .popup-container p {
            color: #FFFFFF !important;
            font-family: 'Gotham', sans-serif !important;
            font-weight: 600 !important;
            margin-bottom: 10px !important;
            font-size: 14px !important;
            overflow-y: auto !important;
            text-align: center !important;
            padding-right: 10px !important;
        }
        .hover-reveal-parentcontainer .popup-container p::-webkit-scrollbar {
            width: 8px !important; /* Adjust width */
        }
        .hover-reveal-parentcontainer .popup-container p::-webkit-scrollbar-thumb {
            background-color: #FFAE00 !important;
            border-radius: 10px !important;
        }
        .hover-reveal-parentcontainer .popup-container p::-webkit-scrollbar-track {
            background-color: #222 !important;
            border-radius: 10px !important;
        }
        .hover-reveal-parentcontainer .grid-item:hover .popup-container {
            visibility: visible !important;
            opacity: 1 !important;
            transform: translateY(0) !important;
        }
        .hover-reveal-parentcontainer .close-button {
            position: absolute !important;
            top: 10px !important;
            right: 15px !important;
            font-size: 20px !important;
            color: white !important;
            cursor: pointer !important;
            background: #FFAE00 !important;
            padding: 5px 10px !important;
            border-radius: 50% !important;
            transition: background 0.3s !important;
        }

        .hover-reveal-parentcontainer .close-button:hover {
            background: rgba(255, 255, 255, 0.6) !important;
        }
    </style>
<!-- <div class="parent-container"> -->
<div class="hover-reveal-parentcontainer">
    <div class="hover-reveal-grid">
        <?php
        $speakers = [
            ["Leanne Pilkington", "CEO Laing+Simmons", "3rd.webp", "CEO Panelist", "Leanne Pilkington is one of the most influential figures in Australian real estate, known for her leadership and commitment to innovation. As CEO of Laing+Simmons and a former President of the Real Estate Institute of Australia, she has been a strong advocate for industry standards, diversity, and professional development. Her impact extends beyond business growth, as she continues to shape the future of real estate leadership."],
            ["Charles Tarbey", "Chairman of Century 21 Australasia", "4th.webp", "CEO Panelist", "Charles Tarbey is a recognised leader with decades of experience in real estate, serving as Chairman of Century 21 Australasia. Under his leadership, Century 21 has become one of the most recognisable and respected real estate brands in Australia. With a deep understanding of business scaling, team development, and market adaptation, he has successfully built and sustained a powerhouse in the industry."],
            ["Matt Lahood", "CEO The Agency", "5th.webp", "CEO Panelist", "Matt Lahood is a visionary in real estate, known for his modern approach to agency leadership. As CEO of The Agency, he has redefined how real estate businesses operate by focusing on technology, culture, and client experience. With a proven track record of building high-performance teams, he is regarded as one of the top business leaders in the industry."]
        ];

        foreach ($speakers as $speaker) {
            $image_url = esc_url(plugin_dir_url(__FILE__) . 'public/' . $speaker[2]);
            ?>
            <div class="grid-item">
                <img src="<?php echo $image_url; ?>" alt="<?php echo esc_attr($speaker[0]); ?>">
                <h2><?php echo esc_html($speaker[0]); ?></h2>
                <p><?php echo esc_html($speaker[1]); ?></p>
                <!--pop up on hover-->
                <div class="popup-container" onclick="hidePopup(this)">
                    <?php if (!empty($speaker[4])) : ?>
                        <h3><?php echo esc_html($speaker[3]); ?></h3>
                        <p><?php echo esc_html($speaker[4]); ?></p>
                    <?php else : ?>
                        <h2><?php echo esc_html($speaker[0]); ?></h2>
                        <h2><?php echo esc_html($speaker[3]); ?></h2>
                    <?php endif; ?>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<!-- </div> -->
    <?php
    return ob_get_clean();
}

add_shortcode('hover_reveal2', 'hover_reveal_shortcode2');
?>
