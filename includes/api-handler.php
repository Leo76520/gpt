<?php

// Funktion zum Abrufen von Diamantdaten aus der API
function fetch_diamond_data_from_api() {
    $api_url = 'https://intg-customer-staging.nivodaapi.net/api/diamonds';
    $username = 'testaccount@sample.com';
    $password = 'staging-nivoda-22';

    $response = wp_remote_get($api_url, array(
        'headers' => array(
            'Authorization' => 'Basic ' . base64_encode("$username:$password"),
            'Content-Type' => 'application/json',
        )
    ));

    if (is_wp_error($response)) {
        return [];
    }

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true);

    return $data;
}

// AJAX-Handler für die Diamantenabfrage im Frontend
add_action('wp_ajax_fetch_diamonds', 'fetch_diamonds');
add_action('wp_ajax_nopriv_fetch_diamonds', 'fetch_diamonds');

function fetch_diamonds() {
    // Überprüfen, ob Filterparameter übergeben wurden
    $filters = isset($_POST['filters']) ? $_POST['filters'] : [];
    $query = build_diamond_query($filters);

    // API-Abfrage an den Staging-Server
    $response = wp_remote_post('https://intg-customer-staging.nivodaapi.net/api/diamonds', [
        'headers' => [
            'Authorization' => 'Basic ' . base64_encode('testaccount@sample.com:staging-nivoda-22'),
            'Content-Type' => 'application/json',
        ],
        'body' => json_encode(['query' => $query]),
    ]);

    if (is_wp_error($response)) {
        wp_send_json_error('Fehler beim Abrufen der Daten.');
        return;
    }

    $body = json_decode(wp_remote_retrieve_body($response), true);
    $diamonds = $body['data']['diamonds'] ?? [];

    wp_send_json($diamonds);
}

// Funktion zum Erstellen der GraphQL-Abfrage basierend auf Filtern
function build_diamond_query($filters) {
    $filterQuery = [];

    if (!empty($filters['carat'])) {
        $filterQuery[] = "carat: { eq: {$filters['carat']} }";
    }
    if (!empty($filters['color'])) {
        $filterQuery[] = "color: \"{$filters['color']}\"";
    }
    if (!empty($filters['clarity'])) {
        $filterQuery[] = "clarity: \"{$filters['clarity']}\"";
    }
    if (!empty($filters['price'])) {
        $filterQuery[] = "price: { lte: {$filters['price']} }";
    }

    $filterString = implode(', ', $filterQuery);

    return "
        query {
            diamonds(filter: { $filterString }) {
                id
                certificate {
                    certificateNumber
                    carat
                    color
                    clarity
                }
                image
                video
                price
            }
        }
    ";
}
