<?php
/**
 * Plugin Name: 24Diamonds
 * Description: Ein benutzerdefiniertes Plugin zur Anzeige und Filterung von Diamanten über die Nivoda API.
 * Version: 1.5
 * Author: Leandro Terras Rodrigues
 */

defined('ABSPATH') or die('Direct script access disallowed.');

define('DIAMOND_PLUGIN_DIR', plugin_dir_path(__FILE__));

// API und Shortcode-Dateien laden
include(DIAMOND_PLUGIN_DIR . 'includes/api-handler.php');

// Stile und Skripte einbinden
function diamond_plugin_assets() {
    wp_enqueue_style('diamond-new-style', plugin_dir_url(__FILE__) . 'assets/css/style.css'); // Assuming css.css is saved in assets/css/
    wp_enqueue_script('diamond-configurator-js', plugin_dir_url(__FILE__) . 'assets/js/diamond-configurator.js', array('jquery'), '1.0', true);

    // AJAX-URL zur Nutzung in JavaScript hinzufügen
    wp_localize_script('diamond-configurator-js', 'diamond_ajax', array('ajax_url' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'diamond_plugin_assets');

// Shortcode für den Diamant-Konfigurator
function render_diamond_konfigurator() {
    ob_start();
    ?>
    <!-- Start des neuen HTML-Inhalts -->
    <div class="mainPage">
    <div class="showcase-container ringBuilderStepsMenu container-fluid">
        <div class="ringBuildermenusBox">
            <div class="rcs_shape_wizard d-md-block d-none">
                <div class="justify-content-center row">
                    <div class="d-flex align-items-center col-md-3">
                        <div class="headingTopRingBuilderMenus"><span>Design Your Own</span>
                            <h3>Diamond Engagement Ring</h3>
                        </div>
                    </div>
                    <div class="rcs_shpae_padding col-3">
                        <div class="rcs_shape_wizard_step-2">
                            <div class="StepsNum active">1</div>
                            <div class="rcs_shape_wizard_content">
                                <ul>
                                    <li class="rcs_setting_details active">
                                        <h2 style="cursor: pointer;">Choose a Diamond</h2><a aria-current="page"
                                            class="active" href="#">Search</a>
                                    </li>
                                    <li class="rcs_setting_price active"></li>
                                    <li class="rcs_shape_wizard_img"><img
                                            src="https://24diamonds.de/wp-content/uploads/2024/11/diamond.bd2c3764ab4ba989b17a.gif"
                                            alt="empty diamond setting" class=""></li>
                                </ul>
                            </div><svg class="ArrowRigt active" width="18" height="61" viewBox="0 0 18 61" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.05" d="M0.999997 1L17 30.5L1 60" stroke="black" stroke-width="2"
                                    stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="rcs_shpae_padding col-3">
                        <div class="rcs_shape_wizard_step-1">
                            <div class="StepsNum">2</div>
                            <div class="rcs_shape_wizard_content">
                                <ul>
                                    <li class="rcs_setting_details">
                                        <h2 style="cursor: pointer;">Choose a Setting</h2><a
                                            href="#">Search</a>
                                    </li>
                                    <li class="rcs_setting_price"></li>
                                    <li class="rcs_shape_wizard_img"><img
                                            src="https://24diamonds.de/wp-content/uploads/2024/11/empty-ring.25113c8431f08f078cbe.gif"
                                            alt="emplty ring setting" class=""></li>
                                </ul>
                            </div><svg class="ArrowRigt" width="18" height="61" viewBox="0 0 18 61" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.05" d="M0.999997 1L17 30.5L1 60" stroke="black" stroke-width="2"
                                    stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="rcs_shpae_padding col-3">
                        <div class="rcs_shape_wizard_step-3">
                            <div class="StepsNum">3</div>
                            <div class="rcs_shape_wizard_content">
                                <ul>
                                    <li class="rcs_setting_details">
                                        <h2>Complete Ring</h2><a aria-current="page" class="active"
                                            href="#"
                                            style="text-decoration: unset; cursor: unset;">Review Your Ring</a>
                                    </li>
                                    <li class="rcs_setting_price"></li>
                                    <li class="rcs_shape_wizard_img"><img
                                            src="https://24diamonds.de/wp-content/uploads/2024/11/diamond-ring.7e114480e293663634ee.gif"
                                            alt="emplty ring setting" class=""></li>
                                </ul>
                            </div><svg class="ArrowRigt" width="18" height="61" viewBox="0 0 18 61" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.05" d="M0.999997 1L17 30.5L1 60" stroke="black" stroke-width="2"
                                    stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="m-auto w-100 d-block d-md-none position-relative row">
                <div class="d-flex widget text-left w-100 mb-20 widget erd-steps">
                    <div class="steps-1-2-3-block active">
                        <div class="d-flex step"><span class="title"><strong>Diamond </strong></span><span
                                class="rhombus"></span><span class="rhombus-top"></span></div>
                    </div>
                    <div class="steps-1-2-3-block ">
                        <div class="d-flex step"><span class="title"> <strong>Setting </strong></span><span
                                class="rhombus"></span><span class="rhombus-top"></span></div>
                    </div>
                    <div class="steps-1-2-3-block" style="overflow: hidden;">
                        <div class="d-flex step"><span class="step-number"></span><span class="title"><strong>Complete
                                </strong></span><span class="rhombus hide"></span><span class="rhombus-top hide"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="rcs_ringsetting_section">
        <div class="rcs_shap-wizard_container showcase-container container-fluid">
            <div class="RingDiamondShop_MainBoxRingDiamondShop__C8iQg">
                <div class="RingDiamondShop_LeftContainer__0Ad+l">
                    <div class="RingDiamondShop_titlebox__80qW5">
                        <h3 class="RingDiamondShop_Title__F9Sur">Filters</h3><button type="button"
                            class="RingDiamondShop_ShowcaseClearFilter__hwUvQ btn btn-none"><svg
                                class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium css-vubbuv" focusable="false"
                                aria-hidden="true" viewBox="0 0 24 24" data-testid="ReplayIcon">
                                <path
                                    d="M12 5V1L7 6l5 5V7c3.31 0 6 2.69 6 6s-2.69 6-6 6-6-2.69-6-6H4c0 4.42 3.58 8 8 8s8-3.58 8-8-3.58-8-8-8">
                                </path>
                            </svg> Reset</button>
                    </div>
                    <div class="RingDiamondShop_showcase_diamonds_page_top_btn__SXmgY">
                        <h4 class="RingDiamondShop_showcase_diamonds_page_top_btn_title__hWjA8">Diamond</h4>
                        <ul class="d-flex justify-content-between align-item-center">
                            <li><button type="button" class="RingDiamondShop_active__0WiGk btn btn-outlined"><svg
                                        width="22" height="30" viewBox="0 0 22 30" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M14.9548 11.732C17.9667 13.1369 20 16.093 20 19.4329C20 24.0898 16.0469 28.0005 11 28.0005C5.95309 28.0005 2 24.0898 2 19.4329C2 16.2385 3.85995 13.3953 6.65706 11.9245L5.5413 10.2562C2.23063 12.0777 0 15.505 0 19.4329C0 25.2692 4.92487 30.0005 11 30.0005C17.0751 30.0005 22 25.2692 22 19.4329C22 15.3875 19.634 11.8731 16.1588 10.0971L14.9548 11.732Z"
                                            fill="var(--primary)"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M8.13943 6.4007V7.34632L8.47883 7.03375C8.66551 6.86186 9.12605 6.44027 9.50225 6.0969C9.87846 5.75352 10.1863 5.46865 10.1863 5.46382C10.1863 5.45901 9.72574 5.45508 9.16285 5.45508H8.13943V6.4007ZM11.8154 5.4637C11.8154 5.47607 13.8374 7.321 13.8509 7.321C13.8572 7.321 13.8623 6.90117 13.8623 6.38804V5.45508H12.8388C12.276 5.45508 11.8154 5.45895 11.8154 5.4637ZM9.80517 6.65671L8.62037 7.73678L9.81062 7.74201C10.4652 7.74489 11.5368 7.74489 12.1918 7.74201L13.3827 7.73678L12.2042 6.66247C11.556 6.0716 11.0176 5.58557 11.0078 5.58241C10.998 5.57922 10.4568 6.06266 9.80517 6.65671ZM6.62394 6.8172C6.14213 7.30981 5.74481 7.72052 5.74099 7.72989C5.73715 7.73926 6.13426 7.74692 6.62344 7.74692H7.51284V6.83424C7.51284 6.33227 7.50993 5.92156 7.50638 5.92156C7.50283 5.92156 7.10572 6.3246 6.62394 6.8172ZM14.4889 6.82939V7.74692H15.3765C15.8647 7.74692 16.2642 7.74177 16.2642 7.73548C16.2642 7.72536 14.888 6.30872 14.6008 6.02319L14.4889 5.91186V6.82939ZM5.67825 8.37164C5.69172 8.40359 9.77432 13.1836 9.78186 13.1763C9.78604 13.1722 9.30287 12.0881 8.70814 10.7672L7.62681 8.36552L6.64902 8.36024C6.11122 8.35734 5.67438 8.36247 5.67825 8.37164ZM8.35506 8.46186C8.38146 8.52041 8.98517 9.86205 9.69664 11.4433C10.4081 13.0245 10.995 14.3182 11.0009 14.3182C11.0068 14.3182 11.5936 13.0245 12.305 11.4433C13.0165 9.86205 13.6201 8.52041 13.6466 8.46186L13.6947 8.35538H11.0008H8.30704L8.35506 8.46186ZM14.3323 8.46186C14.1284 8.89798 12.2139 13.1705 12.2198 13.1762C12.2272 13.1835 16.3101 8.40348 16.3234 8.37191C16.3272 8.36282 15.892 8.35538 15.3562 8.35538H14.3821L14.3323 8.46186Z"
                                            fill="var(--primary)"></path>
                                        <path
                                            d="M13.6363 4.04184C12.6962 5.03077 11.4819 4.80576 10.9922 4.56964C11.0456 4.25852 11.2192 3.88443 11.2994 3.73627C11.7588 2.70289 12.9419 1.77785 13.4761 1.44451C11.5397 1.97231 10.645 4.34741 10.645 4.3613C10.645 3.66127 10.832 3.05106 10.9255 2.83346C11.3528 1.74452 12.4033 1.1019 12.8752 0.916706L15.6128 0C15.5273 0.633361 15.1142 1.67137 14.9183 2.1112C14.6513 2.91124 13.9524 3.73164 13.6363 4.04184Z"
                                            fill="var(--primary)"></path>
                                        <path
                                            d="M8.5964 4.23139C9.29905 5.12984 10.1383 4.70941 10.4701 4.38689C10.0111 3.0876 9.00628 2.37115 8.56127 2.17534C9.61056 2.25827 10.3882 3.523 10.6458 4.145C10.6177 3.95149 10.5326 3.61515 10.4936 3.47117C10.1539 2.10623 9.29905 1.79523 9.28734 1.77795C8.37389 1.38056 7.09741 1.38056 7.09741 1.36328C7.68764 3.20164 8.34267 4.04134 8.5964 4.23139Z"
                                            fill="var(--primary)"></path>
                                    </svg>Earth-Mined</button></li>
                            <li><button type="button" class="btn btn-outlined"><svg width="25" height="30"
                                        viewBox="0 0 25 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M9.2508 1.15571V2.31141L9.63648 1.92941C9.84862 1.71933 10.372 1.20407 10.7995 0.78441C11.227 0.364753 11.5768 0.016583 11.5768 0.0106835C11.5768 0.00480883 11.0534 0 10.4138 0H9.2508V1.15571ZM13.4281 0.0105348C13.4281 0.0256554 15.7258 2.28048 15.7412 2.28048C15.7482 2.28048 15.754 1.76737 15.754 1.14024V0H14.591C13.9514 0 13.4281 0.00473445 13.4281 0.0105348ZM11.1437 1.4686L9.79733 2.78863L11.1499 2.79502C11.8938 2.79854 13.1114 2.79854 13.8557 2.79502L15.2091 2.78863L13.8698 1.47564C13.1332 0.7535 12.5214 0.159485 12.5103 0.155618C12.4992 0.151726 11.8842 0.742568 11.1437 1.4686ZM7.52865 1.66475C6.98115 2.2668 6.52965 2.76875 6.5253 2.7802C6.52094 2.79165 6.9722 2.80102 7.52808 2.80102H8.53876V1.68557C8.53876 1.07207 8.53546 0.57012 8.53143 0.57012C8.52739 0.57012 8.07613 1.0627 7.52865 1.66475ZM16.4661 1.67965V2.80102H17.4748C18.0296 2.80102 18.4835 2.79473 18.4835 2.78704C18.4835 2.77467 16.9197 1.04329 16.5933 0.694331L16.4661 0.558271V1.67965ZM6.454 3.56454C6.46931 3.60358 11.1086 9.44559 11.1172 9.43662C11.1219 9.43166 10.5729 8.10673 9.89706 6.49232L8.66828 3.55705L7.55716 3.55061C6.94602 3.54706 6.44961 3.55333 6.454 3.56454ZM9.49583 3.67479L11.0204 7.3186C11.8288 9.25111 12.4958 10.8323 12.5025 10.8323C12.5091 10.8323 13.176 9.25111 13.9845 7.3186L15.5089 3.67479L15.5636 3.54466H12.5024H9.44126L9.49583 3.67479ZM16.2882 3.67479C16.0564 4.20781 13.8808 9.42953 13.8875 9.43655C13.896 9.44542 18.5356 3.60345 18.5507 3.56486C18.5551 3.55375 18.0605 3.54466 17.4517 3.54466H16.3447L16.2882 3.67479ZM17.2243 7.33667C20.6323 9.12487 23 12.7902 23 17.0847C23 23.1753 18.2379 28.0001 12.5 28.0001C6.76214 28.0001 2 23.1753 2 17.0847C2 12.9694 4.17425 9.43185 7.35462 7.57024L6.29688 5.8693C2.53478 8.09546 0 12.2842 0 17.0847C0 24.2177 5.59644 30.0001 12.5 30.0001C19.4036 30.0001 25 24.2177 25 17.0847C25 12.1406 22.3113 7.84537 18.3622 5.6748L17.2243 7.33667ZM11.6953 15.0002C12.3634 15.0002 12.905 14.4407 12.905 13.7504C12.905 13.0601 12.3634 12.5005 11.6953 12.5005C11.0272 12.5005 10.4856 13.0601 10.4856 13.7504C10.4856 14.4407 11.0272 15.0002 11.6953 15.0002ZM10.8889 16.6643C11.1116 16.6643 11.2921 16.4778 11.2921 16.2477C11.2921 16.0176 11.1116 15.8311 10.8889 15.8311C10.6662 15.8311 10.4856 16.0176 10.4856 16.2477C10.4856 16.4778 10.6662 16.6643 10.8889 16.6643ZM13.7126 16.2477C13.7126 16.4778 13.532 16.6643 13.3093 16.6643C13.0866 16.6643 12.9061 16.4778 12.9061 16.2477C12.9061 16.0176 13.0866 15.8311 13.3093 15.8311C13.532 15.8311 13.7126 16.0176 13.7126 16.2477ZM11.695 18.3323C11.9177 18.3323 12.0982 18.1457 12.0982 17.9156C12.0982 17.6856 11.9177 17.499 11.695 17.499C11.4723 17.499 11.2918 17.6856 11.2918 17.9156C11.2918 18.1457 11.4723 18.3323 11.695 18.3323ZM12.5028 26.6633C17.6248 26.6633 21.777 22.5853 21.777 17.5548C21.777 14.7362 19.8912 15.8768 17.3318 17.4248L17.3318 17.4248C15.3233 18.6395 12.9001 20.1051 10.648 20.1051C8.04843 20.1051 6.17645 18.1524 4.96313 16.8868C3.78581 15.6587 3.22864 15.0775 3.22864 17.5548C3.22864 22.5853 7.38084 26.6633 12.5028 26.6633ZM13.3113 24.1627C13.9794 24.1627 14.521 23.6031 14.521 22.9128C14.521 22.2225 13.9794 21.663 13.3113 21.663C12.6432 21.663 12.1016 22.2225 12.1016 22.9128C12.1016 23.6031 12.6432 24.1627 13.3113 24.1627ZM8.87321 22.4962C8.87321 22.9564 8.51215 23.3295 8.06676 23.3295C7.62137 23.3295 7.26031 22.9564 7.26031 22.4962C7.26031 22.036 7.62137 21.663 8.06676 21.663C8.51215 21.663 8.87321 22.036 8.87321 22.4962ZM17.3412 22.4984C18.0093 22.4984 18.5509 21.9388 18.5509 21.2485C18.5509 20.5582 18.0093 19.9986 17.3412 19.9986C16.6731 19.9986 16.1315 20.5582 16.1315 21.2485C16.1315 21.9388 16.6731 22.4984 17.3412 22.4984ZM15.3253 25.4141C15.3253 25.6441 15.1448 25.8307 14.9221 25.8307C14.6994 25.8307 14.5188 25.6441 14.5188 25.4141C14.5188 25.184 14.6994 24.9974 14.9221 24.9974C15.1448 24.9974 15.3253 25.184 15.3253 25.4141ZM11.4935 21.2483C11.6048 21.2483 11.6951 21.155 11.6951 21.04C11.6951 20.9249 11.6048 20.8317 11.4935 20.8317C11.3821 20.8317 11.2919 20.9249 11.2919 21.04C11.2919 21.155 11.3821 21.2483 11.4935 21.2483Z"
                                            fill="var(--primary)"></path>
                                    </svg>Lab-Grown</button></li>
                        </ul>
                    </div>
                    <div
                        class="rcs_diamond_filter_section rcs_diamond_filter_section_desktop RingDiamondShop_FilterBox__kivG1">
                        <div class="RingDiamondShop_FilterBox_inner__jnw2Y">
                            <h2 title="Diamond Shape" class="RingDiamondShop_FilterBoxTitle__9sfUX">Select Diamond Shape
                            </h2>
                            <ul
                                class="action-area--soLSw table-align_filter--GVxiB RingDiamondShop_FilterBoxIcons__mLXxC">
                                <li data-qa="ShapeFilter-Round" class="longFilter--VqAB5 item--YBPgi"><span
                                        class="single-item-container--Xo5ic"><img
                                            src="https://24diamonds.de/wp-content/uploads/2024/11/huyz5vs00zsm3asyw2d.svg"
                                            class="engList_filter_shape" alt="Round"><span
                                            class="title--jqbwB RingDiamondShop_shapeTitle__qb0SY">Round</span></span>
                                </li>
                                <li data-qa="ShapeFilter-Round" class="longFilter--VqAB5 item--YBPgi"><span
                                        class="single-item-container--Xo5ic"><img
                                            src="https://24diamonds.de/wp-content/uploads/2024/11/Princess.svg"
                                            class="engList_filter_shape" alt="Princess"><span
                                            class="title--jqbwB RingDiamondShop_shapeTitle__qb0SY">Princess</span></span>
                                </li>
                                <li data-qa="ShapeFilter-Round" class="longFilter--VqAB5 item--YBPgi"><span
                                        class="single-item-container--Xo5ic"><img
                                            src="https://24diamonds.de/wp-content/uploads/2024/11/Kissen.svg"
                                            class="engList_filter_shape" alt="Cushion"><span
                                            class="title--jqbwB RingDiamondShop_shapeTitle__qb0SY">Cushion</span></span>
                                </li>
                                <li data-qa="ShapeFilter-Round" class="longFilter--VqAB5 item--YBPgi"><span
                                        class="single-item-container--Xo5ic"><img
                                            src="https://24diamonds.de/wp-content/uploads/2024/11/Emerald.svg"
                                            class="engList_filter_shape" alt="Emerald"><span
                                            class="title--jqbwB RingDiamondShop_shapeTitle__qb0SY">Emerald</span></span>
                                </li>
                                <li data-qa="ShapeFilter-Round" class="longFilter--VqAB5 item--YBPgi"><span
                                        class="single-item-container--Xo5ic"><img
                                            src="https://24diamonds.de/wp-content/uploads/2024/11/Oval.svg"
                                            class="engList_filter_shape" alt="Oval"><span
                                            class="title--jqbwB RingDiamondShop_shapeTitle__qb0SY">Oval</span></span>
                                </li>
                                <li data-qa="ShapeFilter-Round" class="longFilter--VqAB5 item--YBPgi"><span
                                        class="single-item-container--Xo5ic"><img
                                            src="https://24diamonds.de/wp-content/uploads/2024/11/Radiant.svg"
                                            class="engList_filter_shape" alt="Radiant"><span
                                            class="title--jqbwB RingDiamondShop_shapeTitle__qb0SY">Radiant</span></span>
                                </li>
                                <li data-qa="ShapeFilter-Round" class="longFilter--VqAB5 item--YBPgi"><span
                                        class="single-item-container--Xo5ic"><img
                                            src="https://24diamonds.de/wp-content/uploads/2024/11/Asscher.svg"
                                            class="engList_filter_shape" alt="Asscher"><span
                                            class="title--jqbwB RingDiamondShop_shapeTitle__qb0SY">Asscher</span></span>
                                </li>
                                <li data-qa="ShapeFilter-Round" class="longFilter--VqAB5 item--YBPgi"><span
                                        class="single-item-container--Xo5ic"><img
                                            src="https://24diamonds.de/wp-content/uploads/2024/11/Marquise.svg"
                                            class="engList_filter_shape" alt="Marquise"><span
                                            class="title--jqbwB RingDiamondShop_shapeTitle__qb0SY">Marquise</span></span>
                                </li>
                                <li data-qa="ShapeFilter-Round" class="longFilter--VqAB5 item--YBPgi"><span
                                        class="single-item-container--Xo5ic"><img
                                            src="https://24diamonds.de/wp-content/uploads/2024/11/Herz.svg"
                                            class="engList_filter_shape" alt="Heart"><span
                                            class="title--jqbwB RingDiamondShop_shapeTitle__qb0SY">Heart</span></span>
                                </li>
                                <li data-qa="ShapeFilter-Round" class="longFilter--VqAB5 item--YBPgi"><span
                                        class="single-item-container--Xo5ic"><img
                                            src="https://24diamonds.de/wp-content/uploads/2024/11/Pear.svg"
                                            class="engList_filter_shape" alt="Pear"><span
                                            class="title--jqbwB RingDiamondShop_shapeTitle__qb0SY">Pear</span></span>
                                </li>
                                <li data-qa="ShapeFilter-Round" class="longFilter--VqAB5 item--YBPgi"><span
                                        class="single-item-container--Xo5ic"><img
                                            src="https://24diamonds.de/wp-content/uploads/2024/11/Square.svg"
                                            class="engList_filter_shape" alt="Square"><span
                                            class="title--jqbwB RingDiamondShop_shapeTitle__qb0SY">Square</span></span>
                                </li>
                                <li data-qa="ShapeFilter-Round" class="longFilter--VqAB5 item--YBPgi"><span
                                        class="single-item-container--Xo5ic"><img
                                            src="https://24diamonds.de/wp-content/uploads/2024/11/Star.svg"
                                            class="engList_filter_shape" alt="Star"><span
                                            class="title--jqbwB RingDiamondShop_shapeTitle__qb0SY">Star</span></span>
                                </li>
                                <li data-qa="ShapeFilter-Round" class="longFilter--VqAB5 item--YBPgi"><span
                                        class="single-item-container--Xo5ic"><img
                                            src="https://24diamonds.de/wp-content/uploads/2024/11/Old-Miner.svg"
                                            class="engList_filter_shape" alt="Old Miner"><span
                                            class="title--jqbwB RingDiamondShop_shapeTitle__qb0SY">Old Miner</span></span>
                                </li>
                                <li data-qa="ShapeFilter-Round" class="longFilter--VqAB5 item--YBPgi"><span
                                        class="single-item-container--Xo5ic"><img
                                            src="https://24diamonds.de/wp-content/uploads/2024/11/Trilliant.svg"
                                            class="engList_filter_shape" alt="Trilliant"><span
                                            class="title--jqbwB RingDiamondShop_shapeTitle__qb0SY">Trilliant</span></span>
                                </li>
                                <li data-qa="ShapeFilter-Round" class="longFilter--VqAB5 item--YBPgi"><span
                                        class="single-item-container--Xo5ic"><img
                                            src="https://24diamonds.de/wp-content/uploads/2024/11/Rose.svg"
                                            class="engList_filter_shape" alt="Rose"><span
                                            class="title--jqbwB RingDiamondShop_shapeTitle__qb0SY">Rose</span></span>
                                </li>
                                <li data-qa="ShapeFilter-Round" class="longFilter--VqAB5 item--YBPgi"><span
                                        class="single-item-container--Xo5ic"><img
                                            src="https://24diamonds.de/wp-content/uploads/2024/11/Baguette.svg"
                                            class="engList_filter_shape" alt="Baguette"><span
                                            class="title--jqbwB RingDiamondShop_shapeTitle__qb0SY">Baguette</span></span>
                                </li>
                                <li data-qa="ShapeFilter-Round" class="longFilter--VqAB5 item--YBPgi"><span
                                        class="single-item-container--Xo5ic"><img
                                            src="https://24diamonds.de/wp-content/uploads/2024/11/Octagonal.svg"
                                            class="engList_filter_shape" alt="Octagonal"><span
                                            class="title--jqbwB RingDiamondShop_shapeTitle__qb0SY">Octagonal</span></span>
                                </li>
                                <li data-qa="ShapeFilter-Round" class="longFilter--VqAB5 item--YBPgi"><span
                                        class="single-item-container--Xo5ic"><img
                                            src="https://24diamonds.de/wp-content/uploads/2024/11/Hexagonal.svg"
                                            class="engList_filter_shape" alt="Hexagonal"><span
                                            class="title--jqbwB RingDiamondShop_shapeTitle__qb0SY">Hexagonal</span></span>
                                </li>
                            
                        </div>
                        <div class="RingDiamondShop_FilterBox_inner__jnw2Y RingDiamondShop_filterPadding__cuFgc">
                            <h2 title="Diamond Color" class="RingDiamondShop_FilterBoxTitle__9sfUX">Color</h2>
                            <div class="rcs_color_slider">
                                <div class="rc-slider rc-slider-with-marks">
                                    <div class="rc-slider-rail"></div>
                                    <div class="rc-slider-track rc-slider-track-1"
                                        style="left: 0%; right: auto; width: 100%;"></div>
                                    <div class="rc-slider-step"><span class="rc-slider-dot rc-slider-dot-active"
                                            style="left: 0%;"></span><span class="rc-slider-dot rc-slider-dot-active"
                                            style="left: 10%;"></span><span class="rc-slider-dot rc-slider-dot-active"
                                            style="left: 20%;"></span><span class="rc-slider-dot rc-slider-dot-active"
                                            style="left: 30%;"></span><span class="rc-slider-dot rc-slider-dot-active"
                                            style="left: 40%;"></span><span class="rc-slider-dot rc-slider-dot-active"
                                            style="left: 50%;"></span><span class="rc-slider-dot rc-slider-dot-active"
                                            style="left: 60%;"></span><span class="rc-slider-dot rc-slider-dot-active"
                                            style="left: 70%;"></span><span class="rc-slider-dot rc-slider-dot-active"
                                            style="left: 80%;"></span><span class="rc-slider-dot rc-slider-dot-active"
                                            style="left: 90%;"></span><span class="rc-slider-dot rc-slider-dot-active"
                                            style="left: 100%;"></span></div>
                                    <div tabindex="0" class="rc-slider-handle rc-slider-handle-1" role="slider"
                                        aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" aria-disabled="false"
                                        style="left: 0%; right: auto; transform: translateX(-50%);"></div>
                                    <div tabindex="0" class="rc-slider-handle rc-slider-handle-2" role="slider"
                                        aria-valuemin="0" aria-valuemax="100" aria-valuenow="100" aria-disabled="false"
                                        style="left: 100%; right: auto; transform: translateX(-50%);"></div>
                                    <div class="rc-slider-mark"><span
                                            class="rc-slider-mark-text rc-slider-mark-text-active"
                                            style="transform: translateX(-50%); left: 10%;">M</span><span
                                            class="rc-slider-mark-text rc-slider-mark-text-active"
                                            style="transform: translateX(-50%); left: 20%;">L</span><span
                                            class="rc-slider-mark-text rc-slider-mark-text-active"
                                            style="transform: translateX(-50%); left: 30%;">K</span><span
                                            class="rc-slider-mark-text rc-slider-mark-text-active"
                                            style="transform: translateX(-50%); left: 40%;">J</span><span
                                            class="rc-slider-mark-text rc-slider-mark-text-active"
                                            style="transform: translateX(-50%); left: 50%;">I</span><span
                                            class="rc-slider-mark-text rc-slider-mark-text-active"
                                            style="transform: translateX(-50%); left: 60%;">H</span><span
                                            class="rc-slider-mark-text rc-slider-mark-text-active"
                                            style="transform: translateX(-50%); left: 70%;">G</span><span
                                            class="rc-slider-mark-text rc-slider-mark-text-active"
                                            style="transform: translateX(-50%); left: 80%;">F</span><span
                                            class="rc-slider-mark-text rc-slider-mark-text-active"
                                            style="transform: translateX(-50%); left: 90%;">E</span><span
                                            class="rc-slider-mark-text rc-slider-mark-text-active"
                                            style="transform: translateX(-50%); left: 100%;">D</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="RingDiamondShop_FilterBox_inner__jnw2Y RingDiamondShop_filterPadding__cuFgc">
                            <h2 title="Diamond Clarity" class="RingDiamondShop_FilterBoxTitle__9sfUX">Clarity</h2>
                            <div class="rcs_color_slider">
                                <div class="rc-slider rc-slider-with-marks">
                                    <div class="rc-slider-rail"></div>
                                    <div class="rc-slider-track rc-slider-track-1"
                                        style="left: 0%; right: auto; width: 100%;"></div>
                                    <div class="rc-slider-step"><span class="rc-slider-dot rc-slider-dot-active"
                                            style="left: 0%;"></span><span class="rc-slider-dot rc-slider-dot-active"
                                            style="left: 11%;"></span><span class="rc-slider-dot rc-slider-dot-active"
                                            style="left: 22%;"></span><span class="rc-slider-dot rc-slider-dot-active"
                                            style="left: 33%;"></span><span class="rc-slider-dot rc-slider-dot-active"
                                            style="left: 44%;"></span><span class="rc-slider-dot rc-slider-dot-active"
                                            style="left: 55%;"></span><span class="rc-slider-dot rc-slider-dot-active"
                                            style="left: 66%;"></span><span class="rc-slider-dot rc-slider-dot-active"
                                            style="left: 77%;"></span><span class="rc-slider-dot rc-slider-dot-active"
                                            style="left: 88%;"></span><span class="rc-slider-dot rc-slider-dot-active"
                                            style="left: 100%;"></span></div>
                                    <div tabindex="0" class="rc-slider-handle rc-slider-handle-1" role="slider"
                                        aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" aria-disabled="false"
                                        style="left: 0%; right: auto; transform: translateX(-50%);"></div>
                                    <div tabindex="0" class="rc-slider-handle rc-slider-handle-2" role="slider"
                                        aria-valuemin="0" aria-valuemax="100" aria-valuenow="100" aria-disabled="false"
                                        style="left: 100%; right: auto; transform: translateX(-50%);"></div>
                                    <div class="rc-slider-mark"><span
                                            class="rc-slider-mark-text rc-slider-mark-text-active"
                                            style="transform: translateX(-50%); left: 11%;">I1</span><span
                                            class="rc-slider-mark-text rc-slider-mark-text-active"
                                            style="transform: translateX(-50%); left: 22%;">SI2</span><span
                                            class="rc-slider-mark-text rc-slider-mark-text-active"
                                            style="transform: translateX(-50%); left: 33%;">SI1</span><span
                                            class="rc-slider-mark-text rc-slider-mark-text-active"
                                            style="transform: translateX(-50%); left: 44%;">VS2</span><span
                                            class="rc-slider-mark-text rc-slider-mark-text-active"
                                            style="transform: translateX(-50%); left: 55%;">VS1</span><span
                                            class="rc-slider-mark-text rc-slider-mark-text-active"
                                            style="transform: translateX(-50%); left: 66%;">VVS2</span><span
                                            class="rc-slider-mark-text rc-slider-mark-text-active"
                                            style="transform: translateX(-50%); left: 77%;">VVS1</span><span
                                            class="rc-slider-mark-text rc-slider-mark-text-active"
                                            style="transform: translateX(-50%); left: 88%;">IF</span><span
                                            class="rc-slider-mark-text rc-slider-mark-text-active"
                                            style="transform: translateX(-50%); left: 100%;">FL</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="RingDiamondShop_FilterBox_inner__jnw2Y">
                            <h2 title="Diamond Carat" class="RingDiamondShop_FilterBoxTitle__9sfUX">Carat</h2>
                            <div class="rcs_catat_slider"><span class="irs irs--flat js-irs-2"><span class="irs"><span
                                            class="irs-line" tabindex="0"></span><span class="irs-min"
                                            style="visibility: hidden;">0.02</span><span class="irs-max"
                                            style="visibility: hidden;">30.08</span><span class="irs-from"
                                            style="visibility: visible; left: -0.789315%;">0.02</span><span
                                            class="irs-to"
                                            style="visibility: visible; left: 93.5087%;">30.08</span><span
                                            class="irs-single" style="visibility: hidden; left: 42.5426%;">0.02 —
                                            30.08</span></span><span class="irs-grid"></span><span class="irs-bar"
                                        style="left: 2.52581%; width: 94.9484%;"></span><span
                                        class="irs-shadow shadow-from" style="display: none;"></span><span
                                        class="irs-shadow shadow-to" style="display: none;"></span><span
                                        class="irs-handle from" style="left: 0%;"><i></i><i></i><i></i></span><span
                                        class="irs-handle to"
                                        style="left: 94.9484%;"><i></i><i></i><i></i></span></span><input
                                    class="irs-hidden-input" tabindex="-1" readonly=""></div>
                            <ul class="rcs_price_range_input rcs_prince_input_diamond pt-3">
                                <li>
                                    <div class="input-group"><input aria-label="Amount (to the nearest dollar)"
                                            step="0.01" name="min" min="0" type="number" class="form-control"
                                            value="0.02"></div>
                                </li>
                                <li>
                                    <div class="input-group"><input aria-label="Amount (to the nearest dollar)"
                                            step="0.01" min="0" name="max" type="number" class="form-control"
                                            value="30.08"></div>
                                </li>
                            </ul>
                        </div>
                        <div class="RingDiamondShop_FilterBox_inner__jnw2Y">
                            <h2 title="Diamond Price" class="RingDiamondShop_FilterBoxTitle__9sfUX">Price</h2>
                            <div class="rcs_catat_slider"><span class="irs irs--flat js-irs-3"><span class="irs"><span
                                            class="irs-line" tabindex="0"></span><span class="irs-min"
                                            style="visibility: hidden;">91</span><span class="irs-max"
                                            style="visibility: hidden;">3 884 696</span><span class="irs-from"
                                            style="visibility: visible; left: 0.451493%;">91</span><span class="irs-to"
                                            style="visibility: visible; left: 91.2923%;">3 884 696</span><span
                                            class="irs-single" style="visibility: hidden; left: 43.2956%;">91 — 3 884
                                            696</span></span><span class="irs-grid"></span><span class="irs-bar"
                                        style="left: 2.52581%; width: 94.9484%;"></span><span
                                        class="irs-shadow shadow-from" style="display: none;"></span><span
                                        class="irs-shadow shadow-to" style="display: none;"></span><span
                                        class="irs-handle from" style="left: 0%;"><i></i><i></i><i></i></span><span
                                        class="irs-handle to"
                                        style="left: 94.9484%;"><i></i><i></i><i></i></span></span><input
                                    class="irs-hidden-input" tabindex="-1" readonly=""></div>
                            <div class="mt-2 row">
                                <ul class="rcs_price_range_input rcs_prince_input_diamond">
                                    <li class="rcs_price_range_input1"><i>Min</i>
                                        <div class="input-group"><span class="input-group-text">€</span><input
                                                aria-label="Amount (to the nearest dollar)" name="min" type="int"
                                                class="form-control" value="91"></div>
                                    </li>
                                    <li class="rcs_price_range_input1"><i>Max</i>
                                        <div class="input-group"><span class="input-group-text">€</span><input
                                                aria-label="Amount (to the nearest dollar)" name="max" type="int"
                                                class="form-control" value="3884696"></div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="rcs_diamond_filter_section d-block d-md-none">
                        <div class="rcs_filter_accordion_sec rcs_filter_accordion_sec_diamond">
                            <div
                                class="MuiPaper-root MuiPaper-elevation MuiPaper-rounded MuiPaper-elevation1 MuiAccordion-root MuiAccordion-rounded MuiAccordion-gutters css-1wz20g3">
                                <div class="MuiButtonBase-root MuiAccordionSummary-root MuiAccordionSummary-gutters RingDiamondShop_AdvaFilter__eLqZ1 css-1iji0d4"
                                    tabindex="0" role="button" aria-expanded="false" aria-controls="panel1a-content"
                                    id="panel1a-header" style="width: 100%;">
                                    <div
                                        class="MuiAccordionSummary-content MuiAccordionSummary-contentGutters css-17o5nyn">
                                        <p class="MuiTypography-root MuiTypography-body1"><span>Diamonds Filter</span>
                                        </p>
                                    </div>
                                    <div class="MuiAccordionSummary-expandIconWrapper css-1fx8m19"><svg
                                            class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium css-vubbuv"
                                            focusable="false" aria-hidden="true" viewBox="0 0 24 24"
                                            data-testid="ExpandMoreIcon">
                                            <path d="M16.59 8.59 12 13.17 7.41 8.59 6 10l6 6 6-6z"></path>
                                        </svg></div>
                                </div>
                                <div class="MuiCollapse-root MuiCollapse-vertical MuiCollapse-hidden css-a0y2e3"
                                    style="min-height: 0px;">
                                    <div class="MuiCollapse-wrapper MuiCollapse-vertical css-hboir5">
                                        <div class="MuiCollapse-wrapperInner MuiCollapse-vertical css-8atqhb">
                                            <div aria-labelledby="panel1a-header" id="panel1a-content" role="region"
                                                class="MuiAccordion-region">
                                                <div class="MuiAccordionDetails-root pt-0 pb-0 css-u7qq7e">
                                                    <div class="RingDiamondShop_FilterBox__kivG1">
                                                        <div class="RingDiamondShop_FilterBox_inner__jnw2Y ">
                                                            <h2 title="Diamond Shape"
                                                                class="RingDiamondShop_FilterBoxTitle__9sfUX">Shape</h2>
                                                            <ul
                                                                class="action-area--soLSw table-align_filter--GVxiB rcs_gemstone_color_shape RingDiamondShop_FilterBoxIcons__mLXxC">
                                                                <li data-qa="ShapeFilter-Round"
                                                                    class="longFilter--VqAB5 item--YBPgi"><span
                                                                        class="single-item-container--Xo5ic"><img
                                                                            src="#"
                                                                            alt=""><span
                                                                            class="title--jqbwB RingDiamondShop_shapeTitle__qb0SY">Round</span></span>
                                                                </li>
                                                                <li data-qa="ShapeFilter-Round"
                                                                    class="longFilter--VqAB5 item--YBPgi"><span
                                                                        class="single-item-container--Xo5ic"><img
                                                                            src="#"
                                                                            alt=""><span
                                                                            class="title--jqbwB RingDiamondShop_shapeTitle__qb0SY">Princess</span></span>
                                                                </li>
                                                                <li data-qa="ShapeFilter-Round"
                                                                    class="longFilter--VqAB5 item--YBPgi"><span
                                                                        class="single-item-container--Xo5ic"><img
                                                                            src="#"
                                                                            alt=""><span
                                                                            class="title--jqbwB RingDiamondShop_shapeTitle__qb0SY">Cushion</span></span>
                                                                </li>
                                                                <li data-qa="ShapeFilter-Round"
                                                                    class="longFilter--VqAB5 item--YBPgi"><span
                                                                        class="single-item-container--Xo5ic"><img
                                                                            src="#"
                                                                            alt=""><span
                                                                            class="title--jqbwB RingDiamondShop_shapeTitle__qb0SY">Emerald</span></span>
                                                                </li>
                                                                <li data-qa="ShapeFilter-Round"
                                                                    class="longFilter--VqAB5 item--YBPgi"><span
                                                                        class="single-item-container--Xo5ic"><img
                                                                            src="#"
                                                                            alt=""><span
                                                                            class="title--jqbwB RingDiamondShop_shapeTitle__qb0SY">Oval</span></span>
                                                                </li>
                                                                <li data-qa="ShapeFilter-Round"
                                                                    class="longFilter--VqAB5 item--YBPgi"><span
                                                                        class="single-item-container--Xo5ic"><img
                                                                            src="#"
                                                                            alt=""><span
                                                                            class="title--jqbwB RingDiamondShop_shapeTitle__qb0SY">Radiant</span></span>
                                                                </li>
                                                                <li data-qa="ShapeFilter-Round"
                                                                    class="longFilter--VqAB5 item--YBPgi"><span
                                                                        class="single-item-container--Xo5ic"><img
                                                                            src="#"
                                                                            alt=""><span
                                                                            class="title--jqbwB RingDiamondShop_shapeTitle__qb0SY">Asscher</span></span>
                                                                </li>
                                                                <li data-qa="ShapeFilter-Round"
                                                                    class="longFilter--VqAB5 item--YBPgi"><span
                                                                        class="single-item-container--Xo5ic"><img
                                                                            src="#"
                                                                            alt=""><span
                                                                            class="title--jqbwB RingDiamondShop_shapeTitle__qb0SY">Marquise</span></span>
                                                                </li>
                                                                <li data-qa="ShapeFilter-Round"
                                                                    class="longFilter--VqAB5 item--YBPgi"><span
                                                                        class="single-item-container--Xo5ic"><img
                                                                            src="#"
                                                                            alt=""><span
                                                                            class="title--jqbwB RingDiamondShop_shapeTitle__qb0SY">Heart</span></span>
                                                                </li>
                                                                <li data-qa="ShapeFilter-Round"
                                                                    class="longFilter--VqAB5 item--YBPgi"><span
                                                                        class="single-item-container--Xo5ic"><img
                                                                            src="#"
                                                                            alt=""><span
                                                                            class="title--jqbwB RingDiamondShop_shapeTitle__qb0SY">Pear</span></span>
                                                                </li>
                                                            </ul><button type="button"
                                                                class="RingDiamondShop_OtherShape__ySPej btn btn-none">Other
                                                                Shape<svg width="15" height="12" viewBox="0 0 15 12"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M2.99978 1.00071L1 4.00078L7.5 11L14 4.00007L12.0002 1L2.99978 1.00071ZM11.7323 1.5006L11.898 1.74878L10.0315 3.6151L8.52105 1.5006H11.7323ZM7.90687 1.5006L9.69299 4.00078H5.30701L7.09313 1.5006H7.90687ZM3.26774 1.5006H6.47895L4.96783 3.6151L3.10203 1.74949L3.26774 1.5006ZM1.63463 3.95001L2.81927 2.17394L4.64629 4.00078H1.68117L1.63463 3.95001ZM2.14656 4.50067H4.90296L6.44652 9.13157L2.14656 4.50067ZM7.5 10.2653L7.26871 10.0171L5.43041 4.50067H9.5703L7.73129 10.0171L7.5 10.2653ZM8.55348 9.13086L10.097 4.49996H12.8534L8.55348 9.13086ZM13.3654 3.95001L13.3181 4.00078H10.353L12.18 2.17394L13.3654 3.95001Z"
                                                                        fill="black" stroke="black" stroke-width="0.5">
                                                                    </path>
                                                                </svg></button>
                                                        </div>
                                                        <div
                                                            class="RingDiamondShop_FilterBox_inner__jnw2Y RingDiamondShop_filterPadding__cuFgc">
                                                            <h2 title="Diamond Color"
                                                                class="RingDiamondShop_FilterBoxTitle__9sfUX">Color</h2>
                                                            <div class="rcs_color_slider">
                                                                <div class="rc-slider rc-slider-with-marks">
                                                                    <div class="rc-slider-rail"></div>
                                                                    <div class="rc-slider-track rc-slider-track-1"
                                                                        style="left: 0%; right: auto; width: 100%;">
                                                                    </div>
                                                                    <div class="rc-slider-step"><span
                                                                            class="rc-slider-dot rc-slider-dot-active"
                                                                            style="left: 0%;"></span><span
                                                                            class="rc-slider-dot rc-slider-dot-active"
                                                                            style="left: 10%;"></span><span
                                                                            class="rc-slider-dot rc-slider-dot-active"
                                                                            style="left: 20%;"></span><span
                                                                            class="rc-slider-dot rc-slider-dot-active"
                                                                            style="left: 30%;"></span><span
                                                                            class="rc-slider-dot rc-slider-dot-active"
                                                                            style="left: 40%;"></span><span
                                                                            class="rc-slider-dot rc-slider-dot-active"
                                                                            style="left: 50%;"></span><span
                                                                            class="rc-slider-dot rc-slider-dot-active"
                                                                            style="left: 60%;"></span><span
                                                                            class="rc-slider-dot rc-slider-dot-active"
                                                                            style="left: 70%;"></span><span
                                                                            class="rc-slider-dot rc-slider-dot-active"
                                                                            style="left: 80%;"></span><span
                                                                            class="rc-slider-dot rc-slider-dot-active"
                                                                            style="left: 90%;"></span><span
                                                                            class="rc-slider-dot rc-slider-dot-active"
                                                                            style="left: 100%;"></span></div>
                                                                    <div tabindex="0"
                                                                        class="rc-slider-handle rc-slider-handle-1"
                                                                        role="slider" aria-valuemin="0"
                                                                        aria-valuemax="100" aria-valuenow="0"
                                                                        aria-disabled="false"
                                                                        style="left: 0%; right: auto; transform: translateX(-50%);">
                                                                    </div>
                                                                    <div tabindex="0"
                                                                        class="rc-slider-handle rc-slider-handle-2"
                                                                        role="slider" aria-valuemin="0"
                                                                        aria-valuemax="100" aria-valuenow="100"
                                                                        aria-disabled="false"
                                                                        style="left: 100%; right: auto; transform: translateX(-50%);">
                                                                    </div>
                                                                    <div class="rc-slider-mark"><span
                                                                            class="rc-slider-mark-text rc-slider-mark-text-active"
                                                                            style="transform: translateX(-50%); left: 10%;">M</span><span
                                                                            class="rc-slider-mark-text rc-slider-mark-text-active"
                                                                            style="transform: translateX(-50%); left: 20%;">L</span><span
                                                                            class="rc-slider-mark-text rc-slider-mark-text-active"
                                                                            style="transform: translateX(-50%); left: 30%;">K</span><span
                                                                            class="rc-slider-mark-text rc-slider-mark-text-active"
                                                                            style="transform: translateX(-50%); left: 40%;">J</span><span
                                                                            class="rc-slider-mark-text rc-slider-mark-text-active"
                                                                            style="transform: translateX(-50%); left: 50%;">I</span><span
                                                                            class="rc-slider-mark-text rc-slider-mark-text-active"
                                                                            style="transform: translateX(-50%); left: 60%;">H</span><span
                                                                            class="rc-slider-mark-text rc-slider-mark-text-active"
                                                                            style="transform: translateX(-50%); left: 70%;">G</span><span
                                                                            class="rc-slider-mark-text rc-slider-mark-text-active"
                                                                            style="transform: translateX(-50%); left: 80%;">F</span><span
                                                                            class="rc-slider-mark-text rc-slider-mark-text-active"
                                                                            style="transform: translateX(-50%); left: 90%;">E</span><span
                                                                            class="rc-slider-mark-text rc-slider-mark-text-active"
                                                                            style="transform: translateX(-50%); left: 100%;">D</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="RingDiamondShop_FilterBox_inner__jnw2Y ">
                                                            <h2 title="Diamond Carat"
                                                                class="RingDiamondShop_FilterBoxTitle__9sfUX">Carat</h2>
                                                            <div class="rcs_catat_slider"><span
                                                                    class="irs irs--flat js-irs-0"><span
                                                                        class="irs"><span class="irs-line"
                                                                            tabindex="0"></span><span class="irs-min"
                                                                            style="">0.02</span><span class="irs-max"
                                                                            style="">30.08</span><span
                                                                            class="irs-from">0</span><span
                                                                            class="irs-to">0</span><span
                                                                            class="irs-single">0</span></span><span
                                                                        class="irs-grid"></span><span
                                                                        class="irs-bar"></span><span
                                                                        class="irs-shadow shadow-from"></span><span
                                                                        class="irs-shadow shadow-to"></span><span
                                                                        class="irs-handle from"><i></i><i></i><i></i></span><span
                                                                        class="irs-handle to"><i></i><i></i><i></i></span></span><input
                                                                    class="irs-hidden-input" tabindex="-1" readonly="">
                                                            </div>
                                                            <div class="mt-2 row">
                                                                <ul
                                                                    class="rcs_price_range_input rcs_prince_input_diamond">
                                                                    <li>
                                                                        <div class="input-group"><input
                                                                                aria-label="Amount (to the nearest dollar)"
                                                                                step="0.01" min="0" name="min"
                                                                                type="number" class="form-control"
                                                                                value="0.02"></div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="input-group"><input
                                                                                aria-label="Amount (to the nearest dollar)"
                                                                                step="0.01" name="max" min="0"
                                                                                type="number" class="form-control"
                                                                                value="30.08"></div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="RingDiamondShop_FilterBox_inner__jnw2Y RingDiamondShop_filterPadding__cuFgc">
                                                            <h2 title="Diamond Clarity"
                                                                class="RingDiamondShop_FilterBoxTitle__9sfUX">Clarity
                                                            </h2>
                                                            <div class="rcs_color_slider">
                                                                <div class="rc-slider rc-slider-with-marks">
                                                                    <div class="rc-slider-rail"></div>
                                                                    <div class="rc-slider-track rc-slider-track-1"
                                                                        style="left: 0%; right: auto; width: 100%;">
                                                                    </div>
                                                                    <div class="rc-slider-step"><span
                                                                            class="rc-slider-dot rc-slider-dot-active"
                                                                            style="left: 0%;"></span><span
                                                                            class="rc-slider-dot rc-slider-dot-active"
                                                                            style="left: 11%;"></span><span
                                                                            class="rc-slider-dot rc-slider-dot-active"
                                                                            style="left: 22%;"></span><span
                                                                            class="rc-slider-dot rc-slider-dot-active"
                                                                            style="left: 33%;"></span><span
                                                                            class="rc-slider-dot rc-slider-dot-active"
                                                                            style="left: 44%;"></span><span
                                                                            class="rc-slider-dot rc-slider-dot-active"
                                                                            style="left: 55%;"></span><span
                                                                            class="rc-slider-dot rc-slider-dot-active"
                                                                            style="left: 66%;"></span><span
                                                                            class="rc-slider-dot rc-slider-dot-active"
                                                                            style="left: 77%;"></span><span
                                                                            class="rc-slider-dot rc-slider-dot-active"
                                                                            style="left: 88%;"></span><span
                                                                            class="rc-slider-dot rc-slider-dot-active"
                                                                            style="left: 100%;"></span></div>
                                                                    <div tabindex="0"
                                                                        class="rc-slider-handle rc-slider-handle-1"
                                                                        role="slider" aria-valuemin="0"
                                                                        aria-valuemax="100" aria-valuenow="0"
                                                                        aria-disabled="false"
                                                                        style="left: 0%; right: auto; transform: translateX(-50%);">
                                                                    </div>
                                                                    <div tabindex="0"
                                                                        class="rc-slider-handle rc-slider-handle-2"
                                                                        role="slider" aria-valuemin="0"
                                                                        aria-valuemax="100" aria-valuenow="100"
                                                                        aria-disabled="false"
                                                                        style="left: 100%; right: auto; transform: translateX(-50%);">
                                                                    </div>
                                                                    <div class="rc-slider-mark"><span
                                                                            class="rc-slider-mark-text rc-slider-mark-text-active"
                                                                            style="transform: translateX(-50%); left: 11%;">I1</span><span
                                                                            class="rc-slider-mark-text rc-slider-mark-text-active"
                                                                            style="transform: translateX(-50%); left: 22%;">SI2</span><span
                                                                            class="rc-slider-mark-text rc-slider-mark-text-active"
                                                                            style="transform: translateX(-50%); left: 33%;">SI1</span><span
                                                                            class="rc-slider-mark-text rc-slider-mark-text-active"
                                                                            style="transform: translateX(-50%); left: 44%;">VS2</span><span
                                                                            class="rc-slider-mark-text rc-slider-mark-text-active"
                                                                            style="transform: translateX(-50%); left: 55%;">VS1</span><span
                                                                            class="rc-slider-mark-text rc-slider-mark-text-active"
                                                                            style="transform: translateX(-50%); left: 66%;">VVS2</span><span
                                                                            class="rc-slider-mark-text rc-slider-mark-text-active"
                                                                            style="transform: translateX(-50%); left: 77%;">VVS1</span><span
                                                                            class="rc-slider-mark-text rc-slider-mark-text-active"
                                                                            style="transform: translateX(-50%); left: 88%;">IF</span><span
                                                                            class="rc-slider-mark-text rc-slider-mark-text-active"
                                                                            style="transform: translateX(-50%); left: 100%;">FL</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="RingDiamondShop_FilterBox_inner__jnw2Y ">
                                                            <h2 title="Diamond Price"
                                                                class="RingDiamondShop_FilterBoxTitle__9sfUX">Price</h2>
                                                            <div class="rcs_catat_slider"><span
                                                                    class="irs irs--flat js-irs-1"><span
                                                                        class="irs"><span class="irs-line"
                                                                            tabindex="0"></span><span class="irs-min"
                                                                            style="">91</span><span class="irs-max"
                                                                            style="">3 884 696</span><span
                                                                            class="irs-from">0</span><span
                                                                            class="irs-to">0</span><span
                                                                            class="irs-single">0</span></span><span
                                                                        class="irs-grid"></span><span
                                                                        class="irs-bar"></span><span
                                                                        class="irs-shadow shadow-from"></span><span
                                                                        class="irs-shadow shadow-to"></span><span
                                                                        class="irs-handle from"><i></i><i></i><i></i></span><span
                                                                        class="irs-handle to"><i></i><i></i><i></i></span></span><input
                                                                    class="irs-hidden-input" tabindex="-1" readonly="">
                                                            </div>
                                                            <div class="mt-2 row">
                                                                <ul
                                                                    class="rcs_price_range_input rcs_prince_input_diamond">
                                                                    <li class="rcs_price_range_input1">
                                                                        <div class="input-group"><span
                                                                                class="input-group-text">$</span><input
                                                                                aria-label="Amount (to the nearest dollar)"
                                                                                name="min" type="int"
                                                                                class="form-control" value="91"></div>
                                                                    </li>
                                                                    <li class="rcs_price_range_input1">
                                                                        <div class="input-group"><span
                                                                                class="input-group-text">$</span><input
                                                                                aria-label="Amount (to the nearest dollar)"
                                                                                name="max" type="int"
                                                                                class="form-control" value="3884696">
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="rcs_diamond_filter_section">
                        <div class="rcs_filter_accordion_sec rcs_filter_accordion_sec_diamond">
                            <div
                                class="MuiPaper-root MuiPaper-elevation MuiPaper-rounded MuiPaper-elevation1 MuiAccordion-root MuiAccordion-rounded Mui-expanded MuiAccordion-gutters css-1wz20g3">
                                <div class="MuiButtonBase-root MuiAccordionSummary-root Mui-expanded MuiAccordionSummary-gutters RingDiamondShop_AdvaFilter__eLqZ1 css-1iji0d4"
                                    tabindex="0" role="button" aria-expanded="true" aria-controls="panel2a-content"
                                    id="panel2a-header" style="width: 100%;">
                                    <div
                                        class="MuiAccordionSummary-content Mui-expanded MuiAccordionSummary-contentGutters css-17o5nyn">
                                        <p class="MuiTypography-root MuiTypography-body1"><span>Advance Filter</span>
                                        </p>
                                    </div>
                                    <div class="MuiAccordionSummary-expandIconWrapper Mui-expanded css-1fx8m19"><svg
                                            class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium css-vubbuv"
                                            focusable="false" aria-hidden="true" viewBox="0 0 24 24"
                                            data-testid="ExpandMoreIcon">
                                            <path d="M16.59 8.59 12 13.17 7.41 8.59 6 10l6 6 6-6z"></path>
                                        </svg></div>
                                </div>
                                <div class="MuiCollapse-root MuiCollapse-vertical MuiCollapse-entered css-c4sutr"
                                    style="min-height: 0px;">
                                    <div class="MuiCollapse-wrapper MuiCollapse-vertical css-hboir5">
                                        <div class="MuiCollapse-wrapperInner MuiCollapse-vertical css-8atqhb">
                                            <div aria-labelledby="panel2a-header" id="panel2a-content" role="region"
                                                class="MuiAccordion-region">
                                                <div class="MuiAccordionDetails-root css-u7qq7e">
                                                    <div class="RingDiamondShop_FilterBox__kivG1">
                                                        <div
                                                            class="RingDiamondShop_FilterBox_inner__jnw2Y RingDiamondShop_filterPadding__cuFgc">
                                                            <h2 title="Diamond Cut"
                                                                class="RingDiamondShop_FilterBoxTitle__9sfUX">Cut</h2>
                                                            <div class="rcs_cut_slider">
                                                                <div class="rc-slider rc-slider-with-marks">
                                                                    <div class="rc-slider-rail"></div>
                                                                    <div class="rc-slider-track rc-slider-track-1"
                                                                        style="left: 0%; right: auto; width: 100%;">
                                                                    </div>
                                                                    <div class="rc-slider-step"><span
                                                                            class="rc-slider-dot rc-slider-dot-active"
                                                                            style="left: 0%;"></span><span
                                                                            class="rc-slider-dot rc-slider-dot-active"
                                                                            style="left: 25%;"></span><span
                                                                            class="rc-slider-dot rc-slider-dot-active"
                                                                            style="left: 50%;"></span><span
                                                                            class="rc-slider-dot rc-slider-dot-active"
                                                                            style="left: 75%;"></span><span
                                                                            class="rc-slider-dot rc-slider-dot-active"
                                                                            style="left: 100%;"></span></div>
                                                                    <div tabindex="0"
                                                                        class="rc-slider-handle rc-slider-handle-1"
                                                                        role="slider" aria-valuemin="0"
                                                                        aria-valuemax="100" aria-valuenow="0"
                                                                        aria-disabled="false"
                                                                        style="left: 0%; right: auto; transform: translateX(-50%);">
                                                                    </div>
                                                                    <div tabindex="0"
                                                                        class="rc-slider-handle rc-slider-handle-2"
                                                                        role="slider" aria-valuemin="0"
                                                                        aria-valuemax="100" aria-valuenow="100"
                                                                        aria-disabled="false"
                                                                        style="left: 100%; right: auto; transform: translateX(-50%);">
                                                                    </div>
                                                                    <div class="rc-slider-mark"><span
                                                                            class="rc-slider-mark-text rc-slider-mark-text-active"
                                                                            style="transform: translateX(-50%); left: 25%;">Fair</span><span
                                                                            class="rc-slider-mark-text rc-slider-mark-text-active"
                                                                            style="transform: translateX(-50%); left: 50%;">Good</span><span
                                                                            class="rc-slider-mark-text rc-slider-mark-text-active"
                                                                            style="transform: translateX(-50%); left: 75%;">Very
                                                                            Good</span><span
                                                                            class="rc-slider-mark-text rc-slider-mark-text-active"
                                                                            style="transform: translateX(-50%); left: 100%;">Excellent</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="RingDiamondShop_FilterBox_inner__jnw2Y RingDiamondShop_filterPadding__cuFgc">
                                                            <h2 title="Diamond Fluorescence"
                                                                class="RingDiamondShop_FilterBoxTitle__9sfUX">
                                                                Fluorescence</h2>
                                                            <div class="rcs_fluorescence_slider">
                                                                <div class="rc-slider rc-slider-with-marks">
                                                                    <div class="rc-slider-rail"></div>
                                                                    <div class="rc-slider-track rc-slider-track-1"
                                                                        style="left: 0%; right: auto; width: 100%;">
                                                                    </div>
                                                                    <div class="rc-slider-step"><span
                                                                            class="rc-slider-dot rc-slider-dot-active"
                                                                            style="left: 0%;"></span><span
                                                                            class="rc-slider-dot rc-slider-dot-active"
                                                                            style="left: 20%;"></span><span
                                                                            class="rc-slider-dot rc-slider-dot-active"
                                                                            style="left: 40%;"></span><span
                                                                            class="rc-slider-dot rc-slider-dot-active"
                                                                            style="left: 60%;"></span><span
                                                                            class="rc-slider-dot rc-slider-dot-active"
                                                                            style="left: 80%;"></span><span
                                                                            class="rc-slider-dot rc-slider-dot-active"
                                                                            style="left: 100%;"></span></div>
                                                                    <div tabindex="0"
                                                                        class="rc-slider-handle rc-slider-handle-1"
                                                                        role="slider" aria-valuemin="0"
                                                                        aria-valuemax="100" aria-valuenow="0"
                                                                        aria-disabled="false"
                                                                        style="left: 0%; right: auto; transform: translateX(-50%);">
                                                                    </div>
                                                                    <div tabindex="0"
                                                                        class="rc-slider-handle rc-slider-handle-2"
                                                                        role="slider" aria-valuemin="0"
                                                                        aria-valuemax="100" aria-valuenow="100"
                                                                        aria-disabled="false"
                                                                        style="left: 100%; right: auto; transform: translateX(-50%);">
                                                                    </div>
                                                                    <div class="rc-slider-mark"><span
                                                                            class="rc-slider-mark-text rc-slider-mark-text-active"
                                                                            style="transform: translateX(-50%); left: 20%;">Very
                                                                            Strong</span><span
                                                                            class="rc-slider-mark-text rc-slider-mark-text-active"
                                                                            style="transform: translateX(-50%); left: 40%;">Strong</span><span
                                                                            class="rc-slider-mark-text rc-slider-mark-text-active"
                                                                            style="transform: translateX(-50%); left: 60%;">Medium</span><span
                                                                            class="rc-slider-mark-text rc-slider-mark-text-active"
                                                                            style="transform: translateX(-50%); left: 80%;">Faint</span><span
                                                                            class="rc-slider-mark-text rc-slider-mark-text-active"
                                                                            style="transform: translateX(-50%); left: 100%;">None</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="RingDiamondShop_FilterBox_inner__jnw2Y RingDiamondShop_filterPadding__cuFgc">
                                                            <h2 title="Diamond Polish"
                                                                class="RingDiamondShop_FilterBoxTitle__9sfUX">Polish
                                                            </h2>
                                                            <div class="rcs_cut_slider">
                                                                <div class="rc-slider rc-slider-with-marks">
                                                                    <div class="rc-slider-rail"></div>
                                                                    <div class="rc-slider-track rc-slider-track-1"
                                                                        style="left: 0%; right: auto; width: 100%;">
                                                                    </div>
                                                                    <div class="rc-slider-step"><span
                                                                            class="rc-slider-dot rc-slider-dot-active"
                                                                            style="left: 0%;"></span><span
                                                                            class="rc-slider-dot rc-slider-dot-active"
                                                                            style="left: 25%;"></span><span
                                                                            class="rc-slider-dot rc-slider-dot-active"
                                                                            style="left: 50%;"></span><span
                                                                            class="rc-slider-dot rc-slider-dot-active"
                                                                            style="left: 75%;"></span><span
                                                                            class="rc-slider-dot rc-slider-dot-active"
                                                                            style="left: 100%;"></span></div>
                                                                    <div tabindex="0"
                                                                        class="rc-slider-handle rc-slider-handle-1"
                                                                        role="slider" aria-valuemin="0"
                                                                        aria-valuemax="100" aria-valuenow="0"
                                                                        aria-disabled="false"
                                                                        style="left: 0%; right: auto; transform: translateX(-50%);">
                                                                    </div>
                                                                    <div tabindex="0"
                                                                        class="rc-slider-handle rc-slider-handle-2"
                                                                        role="slider" aria-valuemin="0"
                                                                        aria-valuemax="100" aria-valuenow="100"
                                                                        aria-disabled="false"
                                                                        style="left: 100%; right: auto; transform: translateX(-50%);">
                                                                    </div>
                                                                    <div class="rc-slider-mark"><span
                                                                            class="rc-slider-mark-text rc-slider-mark-text-active"
                                                                            style="transform: translateX(-50%); left: 25%;">Fair</span><span
                                                                            class="rc-slider-mark-text rc-slider-mark-text-active"
                                                                            style="transform: translateX(-50%); left: 50%;">Good</span><span
                                                                            class="rc-slider-mark-text rc-slider-mark-text-active"
                                                                            style="transform: translateX(-50%); left: 75%;">Very
                                                                            Good</span><span
                                                                            class="rc-slider-mark-text rc-slider-mark-text-active"
                                                                            style="transform: translateX(-50%); left: 100%;">Excellent</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="RingDiamondShop_FilterBox_inner__jnw2Y RingDiamondShop_filterPadding__cuFgc">
                                                            <h2 title="Diamond Symmetry"
                                                                class="RingDiamondShop_FilterBoxTitle__9sfUX">Symmetry
                                                            </h2>
                                                            <div class="rcs_cut_slider">
                                                                <div class="rc-slider rc-slider-with-marks">
                                                                    <div class="rc-slider-rail"></div>
                                                                    <div class="rc-slider-track rc-slider-track-1"
                                                                        style="left: 0%; right: auto; width: 100%;">
                                                                    </div>
                                                                    <div class="rc-slider-step"><span
                                                                            class="rc-slider-dot rc-slider-dot-active"
                                                                            style="left: 0%;"></span><span
                                                                            class="rc-slider-dot rc-slider-dot-active"
                                                                            style="left: 25%;"></span><span
                                                                            class="rc-slider-dot rc-slider-dot-active"
                                                                            style="left: 50%;"></span><span
                                                                            class="rc-slider-dot rc-slider-dot-active"
                                                                            style="left: 75%;"></span><span
                                                                            class="rc-slider-dot rc-slider-dot-active"
                                                                            style="left: 100%;"></span></div>
                                                                    <div tabindex="0"
                                                                        class="rc-slider-handle rc-slider-handle-1"
                                                                        role="slider" aria-valuemin="0"
                                                                        aria-valuemax="100" aria-valuenow="0"
                                                                        aria-disabled="false"
                                                                        style="left: 0%; right: auto; transform: translateX(-50%);">
                                                                    </div>
                                                                    <div tabindex="0"
                                                                        class="rc-slider-handle rc-slider-handle-2"
                                                                        role="slider" aria-valuemin="0"
                                                                        aria-valuemax="100" aria-valuenow="100"
                                                                        aria-disabled="false"
                                                                        style="left: 100%; right: auto; transform: translateX(-50%);">
                                                                    </div>
                                                                    <div class="rc-slider-mark"><span
                                                                            class="rc-slider-mark-text rc-slider-mark-text-active"
                                                                            style="transform: translateX(-50%); left: 25%;">Fair</span><span
                                                                            class="rc-slider-mark-text rc-slider-mark-text-active"
                                                                            style="transform: translateX(-50%); left: 50%;">Good</span><span
                                                                            class="rc-slider-mark-text rc-slider-mark-text-active"
                                                                            style="transform: translateX(-50%); left: 75%;">Very
                                                                            Good</span><span
                                                                            class="rc-slider-mark-text rc-slider-mark-text-active"
                                                                            style="transform: translateX(-50%); left: 100%;">Excellent</span>
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="Toastify"></div>
</div>
    <!-- Ende des neuen HTML-Inhalts -->
    <?php
    return ob_get_clean();
        
    }add_shortcode('diamond_konfigurator', 'render_diamond_konfigurator');