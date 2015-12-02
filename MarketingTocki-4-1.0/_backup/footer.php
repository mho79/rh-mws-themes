        <?php global $tocki_redux_themeoptions; // globale Variable für die Theme Options. ?>

        <!-- /////////////////////////////////////////////////////////////  FOOTER WIDGETS ///////////////////////////////////////////////////////////// -->
        <?php if ( is_page_template( 'page-blank.php' ) ) {
            // kein Menu auf der blank-page
        } else {
            if ( is_active_sidebar( 'footer-widget-area' ) ) { ?> <!-- Widgets werden angezeigt -->
                <div class="footer-widgets">
                    <?php dynamic_sidebar( 'footer-widget-area' ); ?>
                </div> <!-- /footer-widgets -->
            <?php } ?>

            <div class="wrapper footer-wrapper">
                <!-- /////////////////////////////////////////////////////////////  FOOTER ///////////////////////////////////////////////////////////// -->
                    <div class="footer">
                        <?php if ( is_active_sidebar( 'kontaktzeile-widget-area' ) ) { ?> <!-- Widgets werden angezeigt -->
                            <div class="footer-links">
                                <?php dynamic_sidebar( 'kontaktzeile-widget-area' ); ?>
                            </div> <!-- /footer-links -->
                        <?php } else { ?> <!-- Daten aus Theme Optionen werden angezeigt -->
                            <div class="footer-links">
                                <?php  if (!empty($tocki_redux_themeoptions["tocki_redux_firma"])) { ?><?php echo $tocki_redux_themeoptions["tocki_redux_firma"]; echo " // "; }; ?>
                                <?php  if (!empty($tocki_redux_themeoptions["tocki_redux_firma_zusatz"])) { ?><?php echo $tocki_redux_themeoptions["tocki_redux_firma_zusatz"]; echo " // "; }; ?>
                                <?php  if (!empty($tocki_redux_themeoptions["tocki_redux_strasse"])) { ?><?php echo $tocki_redux_themeoptions["tocki_redux_strasse"]; echo " // "; }; ?>
                                <?php  if (!empty($tocki_redux_themeoptions["tocki_redux_plz"])) { ?><?php echo $tocki_redux_themeoptions["tocki_redux_plz"]; }; ?> <?php  if (!empty($tocki_redux_themeoptions["tocki_redux_ort"])) { ?><?php echo $tocki_redux_themeoptions["tocki_redux_ort"]; }; echo " // "; ?>
                                Tel.: <span>{regiohelden.proxy.number}</span> // 
                                <a class="open-close" href="javascript:void(0);">Impressum</a> // 
                                <a class="datenschutz-open-close" href="javascript:void(0);">Datenschutz</a>
                            </div> <!-- /footer-links -->
                        <?php } ?>
                        
                        <div class="footer-rechts">
                            <?php if ($tocki_redux_themeoptions['tocki_redux_whitelabel'] == 1) { ?><!-- nichts -->
                            <?php } elseif ($tocki_redux_themeoptions['tocki_redux_whitelabel'] == 2) { ?><a href="http://www.regiohelden.de">Lokale Internetwerbung</a> von den <a href="http://www.regiohelden.de">RegioHelden</a>
                            <?php } elseif ($tocki_redux_themeoptions['tocki_redux_whitelabel'] == 3) { ?><!-- Marcapo -->
                            <?php } elseif ($tocki_redux_themeoptions['tocki_redux_whitelabel'] == 4) { ?>Präsentiert von <a href="http://unser-stuttgart.de" target="_blank">Unser-Stuttgart.de</a><!-- Stuttgarter Zeitung -->
                            <?php } else { ?><!-- unknown whitelabel -->
                            <?php } ?>
                        </div> <!-- /footer-rechts -->
                    
                        <div style="clear: both;"></div>
                    
                        <div id="impressum">
                            <?php if ( is_active_sidebar( 'impressum-widget-area' ) ) { ?> <!-- Widgets werden angezeigt -->
                                <?php dynamic_sidebar( 'impressum-widget-area' ); ?>
                            <?php } else { ?> <!-- Daten aus Theme Optionen werden angezeigt -->
                                <div class="impressum-box" itemscope itemtype="http://schema.org/LocalBusiness">
                                    <?php  if (!empty($tocki_redux_themeoptions["tocki_redux_impressum1_switcher"])) { 
                                        echo nl2br($tocki_redux_themeoptions["tocki_redux_impressum1"]); 
                                    } else { ?>
                                        <h3>Verantwortlicher</h3>
                                        <br>
                                        <?php if (!empty($tocki_redux_themeoptions["tocki_redux_name"])) { 
                                            echo nl2br($tocki_redux_themeoptions["tocki_redux_name"]);?><br>
                                        <?php }
                                        if (!empty($tocki_redux_themeoptions["tocki_redux_firma"])) { ?>
                                            <span itemprop="name"><?php echo nl2br($tocki_redux_themeoptions["tocki_redux_firma"]);?></span><br>
                                        <?php } ?>

                                        <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                                            <?php if (!empty($tocki_redux_themeoptions["tocki_redux_strasse"])) { ?>
                                                <span itemprop="streetAddress"><?php echo nl2br($tocki_redux_themeoptions["tocki_redux_strasse"]);?></span><br>
                                            <?php }
                                            if (!empty($tocki_redux_themeoptions["tocki_redux_plz"])) { ?>
                                                <span itemprop="postalCode"><?php echo nl2br($tocki_redux_themeoptions["tocki_redux_plz"]); ?></span>
                                            <?php }
                                            if (!empty($tocki_redux_themeoptions["tocki_redux_ort"])) { ?>
                                                <span itemprop="addressLocality"><?php echo nl2br($tocki_redux_themeoptions["tocki_redux_ort"]);?></span><br>
                                            <?php } ?>
                                        </div><br>

                                        Tel.: <span itemprop="telephone">{regiohelden.proxy.number}</span><br>
                                        E-Mail: <span itemprop="email"><?php $mail = $tocki_redux_themeoptions["tocki_redux_mail"]; $arr = array("@" => "[at]"); echo strtr($mail,$arr); ?></span>
                                    <?php } ?>
                                </div>

                                <div class="impressum-box">
                                    <?php if (!empty($tocki_redux_themeoptions["tocki_redux_impressum2"])) { 
                                        echo nl2br($tocki_redux_themeoptions["tocki_redux_impressum2"]); 
                                    } ?>
                                </div>

                                <div class="impressum-box">
                                    <?php if (!empty($tocki_redux_themeoptions["tocki_redux_impressum3"])) { 
                                        echo nl2br($tocki_redux_themeoptions["tocki_redux_impressum3"]); 
                                    } ?>
                                </div>
                            <?php } ?>
                            <div style="clear: both;"></div>
                            
                            <div class="schliessen" style="font-size:11px;">
                                <a class="open-close" href="javascript:void(0);">Schlie&szlig;en</a>
                            </div>
                            <div style="clear: both;"></div>
                        </div> <!-- /impressum -->

                        <div style="clear: both;"></div>

                        <?php if ( is_active_sidebar( 'datenschutz-widget-area' ) ) { ?> <!-- Widgets werden angezeigt -->
                            <div id="datenschutz">  <!-- Beginn Datenschutz  --> 
                                <?php dynamic_sidebar( 'datenschutz-widget-area' ); ?>
                                <span style="font-size:11px; margin-left: 850px;">
                                    <a class="datenschutz-open-close" href="javascript:void(0);">Schlie&szlig;en</a>
                                </span>
                            </div>  <!-- Ende Datenschutz  --> 
                        <?php } else { ?> <!-- Daten aus Theme Optionen werden angezeigt -->
                            <div id="datenschutz">  <!-- Beginn Datenschutz  --> 
                                <h3>Hinweise zum Datenschutz</h3>
                                Der Schutz Ihrer Privatsphäre ist für uns sehr wichtig. Nachstehend informieren wir Sie ausführlich über den Umgang mit Ihren Daten.<br> 
                                <br> 
                                Sie können unsere Seite besuchen, ohne Angaben zu Ihrer Person zu machen. Wir speichern lediglich Zugriffsdaten ohne Personenbezug wie z.B. den Namen Ihres Internet Service Providers, die Seite, von der aus Sie uns besuchen oder den Namen der angeforderten Datei. Diese Daten werden ausschließlich zur Verbesserung unseres Angebotes ausgewertet und erlauben keinen Rückschluss auf Ihre Person.<br> 
                                <br> 
                                <h3>Erhebung und Verarbeitung personenbezogener Daten</h3>
                                Wir sind bestrebt, Ihnen so viel Kontrolle wie möglich über Ihre persönlichen Daten einzuräumen. Für uns ist es wichtig, dass Sie sich bei Ihrem Besuch auf unserer Website wohl fühlen. Manchmal benötigen wir von Ihnen gleichwohl bestimmte Angaben. Alle Ihre persönlichen Angaben, einschließlich Ihrer E-Mailadresse, werden von uns nur dann erhoben, wenn Sie uns diese von sich aus (also beim Ausfüllen des Kontaktformulars) angeben.<br> 
                                <br> 
                                <h3>Nutzung und Weitergabe personenbezogener Daten</h3>
                                Daten, die Sie im Rahmen dieser Website übermitteln, werden ausschließlich für den angegebenen Zweck verarbeitet und genutzt. Darüber hinaus erfolgt keine weitere Verarbeitung und Nutzung Ihrer Daten für weitere Zwecke. Selbstverständlich findet keine Weitergabe Ihrer Daten statt. Auf Wunsch erteilen wir Ihnen unentgeltlich Auskunft über alle personenbezogenen Daten, die wir über Sie gespeichert haben. Des Weiteren können Sie Ihre Einwilligung jederzeit widerrufen. Der Widerruf gilt dann für die Zukunft.<br> 
                                <br> 
                                <h3>Auskunftsrecht</h3>
                                Nach dem Bundesdatenschutzgesetz haben Sie ein Recht auf unentgeltliche Auskunft über Ihre gespeicherten Daten sowie ggf. ein Recht auf Berichtigung, Sperrung oder Löschung dieser Daten.<br> 
                                <br> 
                                <h3>Ansprechpartner für Datenschutz</h3>
                                Bei Fragen zur Erhebung, Verarbeitung oder Nutzung Ihrer personenbezogenen Daten, bei Auskünften, Berichtigung, Sperrung oder Löschung von Daten sowie Widerruf erteilter Einwilligungen wenden Sie sich bitte an: 
                                <?php $mail = $tocki_redux_themeoptions["tocki_redux_mail"]; $arr = array("@" => "[at]"); echo strtr($mail,$arr); ?>
                                
                                <br> 
                                <br> 
                                <h3>Verwendung von Google Analytics</h3>
                                <p>Diese Website benutzt Google Analytics, einen Webanalysedienst der Google Inc. („Google“). Google Analytics verwendet sog. „Cookies“, Textdateien, die auf Ihrem Computer gespeichert werden und die eine Analyse der Benutzung der Website durch Sie ermöglichen. Die durch das Cookie erzeugten Informationen über Ihre Benutzung dieser Website werden in der Regel an einen Server von Google in den USA übertragen und dort gespeichert. Im Falle der Aktivierung der IP-Anonymisierung auf dieser Website, wird Ihre IP-Adresse von Google jedoch innerhalb von Mitgliedstaaten der Europäischen Union oder in anderen Vertragsstaaten des Abkommens über den Europäischen Wirtschaftsraum zuvor gekürzt. Nur in Ausnahmefällen wird die volle IP-Adresse an einen Server von Google in den USA übertragen und dort gekürzt. Im Auftrag des Betreibers dieser Website wird Google diese Informationen benutzen, um Ihre Nutzung der Website auszuwerten, um Reports über die Websiteaktivitäten zusammenzustellen und um weitere mit der Websitenutzung und der Internetnutzung verbundene Dienstleistungen gegenüber dem Websitebetreiber zu erbringen. Die im Rahmen von Google Analytics von Ihrem Browser übermittelte IP-Adresse wird nicht mit anderen Daten von Google zusammengeführt. Sie können die Speicherung der Cookies durch eine entsprechende Einstellung Ihrer Browser-Software verhindern; wir weisen Sie jedoch darauf hin, dass Sie in diesem Fall gegebenenfalls nicht sämtliche Funktionen dieser Website vollumfänglich werden nutzen können. Sie können darüber hinaus die Erfassung der durch das Cookie erzeugten und auf Ihre Nutzung der Website bezogenen Daten (inkl. Ihrer IP-Adresse) an Google sowie die Verarbeitung dieser Daten durch Google verhindern, indem Sie das unter dem folgenden <a href="http://tools.google.com/dlpage/gaoptout?hl=de">Link</a> verfügbare Browser-Plugin herunterladen und installieren.</p>
                                <p>Sie können die Erfassung durch Google Analytics verhindern, indem Sie auf folgenden Link klicken. Es wird ein Opt-Out-Cookie gesetzt, das die zukünftige Erfassung Ihrer Daten beim Besuch dieser Website verhindert: <a href="javascript:gaOptout()">Google Analytics deaktivieren</a></p>
                                <p>Nähere Informationen zu Nutzungsbedingungen und Datenschutz finden Sie unter http://www.google.com/analytics/terms/de.html bzw. unter https://www.google.de/intl/de/policies/. Wir weisen Sie darauf hin, dass auf dieser Website Google Analytics um den Code „gat._anonymizeIp();“ erweitert wurde, um eine anonymisierte Erfassung von IP-Adressen (sog. IP-Masking) zu gewährleisten.</p>

                                <div class="schliessen" style="font-size:11px;">
                                    <a class="datenschutz-open-close" href="javascript:void(0);">Schlie&szlig;en</a>
                                </div>
                            </div><!-- Ende Datenschutz  --> 
                        <?php } ?>
                    </div><!-- /footer -->
                        
                    <div style="clear: both;"></div>
                </div><!-- Ende footer-wrapper   -->
            </div><!-- /wrapper -->

            <?php wp_footer(); ?>
        <?php } ?>

        <!-- individuelles Scripts der Seite  -->
        <script>
            /* diverse Scripts beim Laden der Seite */
            $(document).ready(function(){
                /* Hide Impressum und Datenschutz DIVs */
                $("#impressum").hide();
                $("#datenschutz").hide();
                $("#bildnachweis").hide();
                 /* farbige Liste-Squares */
                $('.content .leistungen ul li').each(function(i, e) {
                    $(e).contents().wrap('<span class="list-text"></span>');
                });
            });
                
            /* Toggle Impressum */
            $(document).ready(function() {
                $("a.open-close").click(function(){   
                    $("#impressum").fadeSliderToggle("slow");
                    return false;
                });
            });
                
            /* Toggle Datenschutz */
            $(document).ready(function() {
                $("a.datenschutz-open-close").click(function(){   
                    $("#datenschutz").fadeSliderToggle("slow");
                    return false;
                });
            });
                
            /* Toggle Bildnachweis */
            $(document).ready(function() {
                $("a.bildnachweis-open-close").click(function(){   
                    $("#bildnachweis").fadeSliderToggle("slow");
                    return false;
                });
            });
        </script>

        <style>
        	.gambit-bg-parallax[data-bg-size-adjust="dont-scale"]+.bg-parallax-parent .parallax-inner { 
        		background-size: cover !important;
        	}
        </style>

        <?php if (!empty($tocki_redux_themeoptions["tocki_redux_formular_conversion_switcher"])) { ?>
            <script>
                function clickConv() {
                    var google_conversion_id = <?php if (!empty($tocki_redux_themeoptions["tocki_redux_formular_conversion_conversion_id"])) { ?><?php echo $tocki_redux_themeoptions["tocki_redux_formular_conversion_conversion_id"]; } ?>;
                    var google_conversion_label = "<?php  if (!empty($tocki_redux_themeoptions["tocki_redux_formular_conversion_conversion_label"])) { ?><?php echo $tocki_redux_themeoptions["tocki_redux_formular_conversion_conversion_label"]; } ?>;";
                    image = new Image(1,1);
                    image.src = "http://www.googleadservices.com/pagead/conversion/"+google_conversion_id+"/?label="+google_conversion_label+"&script=0";
                }
            </script>
        <?php }

        if (!empty($tocki_redux_themeoptions["tocki_redux_code_footer"])) { 
            echo $tocki_redux_themeoptions["tocki_redux_code_footer"];
        }

        edit_post_link(); ?>
               
        <nav id="mmenu">
            <?php if ( is_page_template( 'page-adwords.php' ) ) {
                adwords_mws_mobile_nav();
            } else { 
                mws_mobile_nav();
            } ?>
        </nav> 

        <script>
            var $menu = $('nav#mmenu'),
                $html = $('body');

            $menu.mmenu({
                classes: "mm-slide"
            });

            $menu.find( 'li > a' ).on('click', function() {
                var href = $(this).attr( 'href' );

                //  if the clicked link is linked to an anchor, scroll the page to that anchor 
                if ( href.slice( 0, 1 ) == '#' ) {
                    $menu.one('closed.mm', function() {
                        setTimeout(function() {
                            $html.animate({
                                scrollTop: $( href ).offset().top
                            }); 
                        }, 10);  
                    });                      
                }
            });
                
            // toggle shrink class when scrolled down
            $(window).scroll(function () {
                if ($(document).scrollTop() > 1 ) {
                    $('body').addClass('shrink', 500);
                } else {
                    $('body').removeClass('shrink', 500);
                }
            });
        </script>

        <?php
        if ( !empty($tocki_redux_themeoptions["tocki_redux_footer"]) ) {
            echo $tocki_redux_themeoptions["tocki_redux_footer"];
        } else {
            if (is_user_logged_in()): ?>
                <!-- Eingeloggte User erhalten kein Google Analytics Code  -->
                <!-- Bugherd  -->
                <script>
                    (function (d, t) {
                        var bh = d.createElement(t), s = d.getElementsByTagName(t)[0];
                        bh.type = 'text/javascript';
                        bh.src = '//www.bugherd.com/sidebarv2.js?apikey=mng5yi483ff6nwtbayoasq';
                        s.parentNode.insertBefore(bh, s);
                    })(document, 'script');
                </script>
            <?php else: ?>
                <script>
                    var gaProperty = 'UA-63619645-1',
                        disableStr = 'ga-disable-' + gaProperty;

                    if (document.cookie.indexOf(disableStr + '=true') > -1) {
                        window[disableStr] = true;
                    }

                    function gaOptout() {
                        document.cookie = disableStr + '=true; expires=Thu, 31 Dec 2099 23:59:59 UTC; path=/';
                        window[disableStr] = true;
                        alert("OptOut war erfolgreich!");
                    }
                </script>

                <script>
                    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

                    ga('create', 'UA-63619645-1', 'auto');
                    ga('set', 'anonymizeIp', true);
                    ga('send', 'pageview');
                </script>
            <?php endif;
        } ?>

        <script>
            window.ParsleyConfig = window.ParsleyConfig || {};
            (function ($) {
              window.ParsleyConfig = $.extend( true, {}, window.ParsleyConfig, {
                messages: {
                  // parsley //////////////////////////////////////
                    defaultMessage: "Die Eingabe scheint nicht korrekt zu sein."
                  , type: {
                        email:      "Die Eingabe muss eine gültige E-Mail-Adresse sein."
                      , url:        "Die Eingabe muss eine gültige URL sein."
                      , urlstrict:  "Die Eingabe muss eine gültige URL sein."
                      , number:     "Die Eingabe muss eine Zahl sein."
                      , digits:     "Die Eingabe darf nur Ziffern enthalten."
                      , dateIso:    "Die Eingabe muss ein gültiges Datum im Format YYYY-MM-DD sein."
                      , alphanum:   "Die Eingabe muss alphanumerisch sein."
                      , phone:      "Die Eingabe muss eine gültige Telefonnummer sein."
                    }
                  , notnull:        "Die Eingabe darf nicht leer sein."
                  , notblank:       "Die Eingabe darf nicht leer sein."
                  , required:       "Dies ist ein Pflichtfeld."
                  , regexp:         "Die Eingabe scheint ungültig zu sein."
                  , min:            "Die Eingabe muss größer oder gleich %s sein."
                  , max:            "Die Eingabe muss kleiner oder gleich %s sein."
                  , range:          "Die Eingabe muss zwischen %s und %s liegen."
                  , minlength:      "Die Eingabe ist zu kurz. Es müssen mindestens %s Zeichen eingegeben werden."
                  , maxlength:      "Die Eingabe ist zu lang. Es dürfen höchstens %s Zeichen eingegeben werden."
                  , rangelength:    "Die Länge der Eingabe ist ungültig. Es müssen zwischen %s und %s Zeichen eingegeben werden."
                  , equalto:        "Dieses Feld muss dem anderen entsprechen."

                  // parsley.extend ///////////////////////////////
                  , minwords:       "Die Eingabe muss mindestens %s Wörter enthalten."
                  , maxwords:       "Die Eingabe darf höchstens %s Wörter enthalten."
                  , rangewords:     "Die Eingabe muss zwischen %s und %s Wörter enthalten."
                  , greaterthan:    "Die Eingabe muss größer als %s sein."
                  , lessthan:       "Die Eingabe muss kleiner als %s sein."
                }
              });
            }(window.jQuery || window.Zepto));
        </script>
    </body>
</html>