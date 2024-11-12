jQuery(document).ready(function ($) {
    let leftValue = 0;
    let rightValue = 100;

    // Funktion zum Abrufen von Diamanten von der API mit Filtern
    function fetchDiamonds(filters = {}) {
        $.ajax({
            url: diamond_ajax.ajax_url,
            method: 'POST',
            data: {
                action: 'fetch_diamonds',
                filters: filters
            },
            success: function (data) {
                displayDiamonds(data);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error("Fehler beim Abrufen der Diamanten:", textStatus, errorThrown);
                $('#diamond-grid').html('<p>Fehler beim Laden der Diamanten.</p>');
            }
        });
    }

    // Funktion zur Anzeige der Diamanten im Container
    function displayDiamonds(diamonds) {
        let diamondHtml = '';
        diamonds.forEach(diamond => {
            diamondHtml += `
                <div class="diamond-item">
                    <img src="${diamond.image}" alt="Diamond">
                    <ul>
                        <li>Karat: ${diamond.certificate.carat}</li>
                        <li>Farbe: ${diamond.certificate.color}</li>
                        <li>Reinheit: ${diamond.certificate.clarity}</li>
                        <li>Preis: ${diamond.price}</li>
                    </ul>
                </div>
            `;
        });
        $('#diamond-grid').html(diamondHtml);
    }

    // Funktion zum Abrufen der Filterwerte und Aktualisieren der Diamantliste
    function updateDiamonds() {
        const filters = {
            carat: $('#filter-carat').val(),
            color: $('#filter-color').val(),
            clarity: $('#filter-clarity').val(),
            price: $('#filter-price').val(),
            colorRange: {
                min: leftValue,
                max: rightValue
            }
        };
        fetchDiamonds(filters);
    }

    // Filter auf Änderungen überwachen
    $('.filter-input').on('change', updateDiamonds);

    // Initiales Laden der Diamanten ohne Filter
    fetchDiamonds();

    // --- Slider Code ---
    const slider = document.getElementById('diamond-color-slider');
    const leftThumb = document.getElementById('left-thumb');
    const rightThumb = document.getElementById('right-thumb');

    // Funktion zum Aktualisieren der Position der Thumbs basierend auf Werten
    function updateThumbPositions() {
        const sliderWidth = slider.clientWidth;
        
        leftThumb.style.left = `${(leftValue / 100) * sliderWidth}px`;
        rightThumb.style.left = `${(rightValue / 100) * sliderWidth}px`;
    }

    // Initialisiere die Thumbs
    updateThumbPositions();

    // Ereignisse zum Verschieben der linken und rechten Thumbs
    leftThumb.addEventListener('mousedown', () => startDrag(startDragLeft, stopDragLeft, dragLeft));
    rightThumb.addEventListener('mousedown', () => startDrag(startDragRight, stopDragRight, dragRight));

    function startDrag(dragFn, stopDragFn, moveFn) {
        event.preventDefault();
        document.addEventListener('mousemove', moveFn);
        document.addEventListener('mouseup', stopDragFn);
    }

    function dragLeft(event) {
        const sliderRect = slider.getBoundingClientRect();
        const offsetX = event.clientX - sliderRect.left;
        leftValue = Math.min(Math.max((offsetX / slider.clientWidth) * 100, 0), rightValue - 10);
        leftValue = Math.round(leftValue / 10) * 10; // Anpassung an Schrittgröße von 10%
        updateThumbPositions();
        updateDiamonds();
    }

    function dragRight(event) {
        const sliderRect = slider.getBoundingClientRect();
        const offsetX = event.clientX - sliderRect.left;
        rightValue = Math.max(Math.min((offsetX / slider.clientWidth) * 100, 100), leftValue + 10);
        rightValue = Math.round(rightValue / 10) * 10; // Anpassung an Schrittgröße von 10%
        updateThumbPositions();
        updateDiamonds();
    }

    function stopDragLeft() {
        document.removeEventListener('mousemove', dragLeft);
        document.removeEventListener('mouseup', stopDragLeft);
    }

    function stopDragRight() {
        document.removeEventListener('mousemove', dragRight);
        document.removeEventListener('mouseup', stopDragRight);
    }
});
