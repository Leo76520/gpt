<?php
/**
 * Funktion zum Rendern des Diamant-Konfigurators
 */
function render_diamond_konfigurator() {
    // Abrufen der Diamant-Daten aus der API
    $diamonds = fetch_diamond_data_from_api();

    // Output Buffering starten, um HTML-Ausgabe zu erfassen
    ob_start();
    ?>
    <div class="diamond-konfigurator">
        <h2>Diamant Konfigurator</h2>
        
        <!-- Schritte des Konfigurators -->
        <div class="step-container">
            <div class="step-indicator active">1</div>
            <div class="step-content">
                <h3>Wählen Sie einen Diamanten</h3>
                <a href="/diamonds">Durchsuchen</a>
            </div>
        </div>

        <div class="step-container">
            <div class="step-indicator">2</div>
            <div class="step-content">
                <h3>Wählen Sie einen Ring</h3>
                <a href="/ringsettings/diamonds">Durchsuchen</a>
            </div>
        </div>

        <div class="step-container">
            <div class="step-indicator">3</div>
            <div class="step-content">
                <h3>Zusammenfassung</h3>
                <a href="/diamonds">Überprüfen Sie Ihren Ring</a>
            </div>
        </div>

        <!-- Diamant-Auswahlbereich (Diamond Grid) -->
        <div class="diamond-grid">
            <?php if (!empty($diamonds) && is_array($diamonds)): ?>
                <?php foreach ($diamonds as $diamond): ?>
                    <div class="diamond-item">
                        <!-- Überprüfen und Anzeigen des Diamant-Bildes -->
                        <?php if (!empty($diamond['image'])): ?>
                            <img src="<?php echo esc_url($diamond['image']); ?>" alt="Diamond Image">
                        <?php else: ?>
                            <img src="/path/to/default-image.jpg" alt="Default Diamond Image"> <!-- Fallback-Bild -->
                        <?php endif; ?>

                        <!-- Diamantdetails -->
                        <ul>
                            <li><strong>Karat:</strong> <?php echo esc_html($diamond['certificate']['carat'] ?? 'N/A'); ?></li>
                            <li><strong>Farbe:</strong> <?php echo esc_html($diamond['certificate']['color'] ?? 'N/A'); ?></li>
                            <li><strong>Reinheit:</strong> <?php echo esc_html($diamond['certificate']['clarity'] ?? 'N/A'); ?></li>
                            <li><strong>Preis:</strong> <?php echo esc_html($diamond['price'] ?? 'N/A'); ?></li>
                        </ul>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Keine Diamanten gefunden.</p>
            <?php endif; ?>
        </div>
    </div>
    <?php
    // Zurückgeben des erfassten HTML
    return ob_get_clean();
}

// Shortcode bei WordPress registrieren
add_shortcode('diamond_konfigurator', 'render_diamond_konfigurator');
