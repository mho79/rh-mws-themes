            <?php global $tocki_redux_themeoptions; // globale Variable für die Theme Options. ?>

            <!-- /////////////////////////////////////////////////////////////  FOOTER WIDGETS ///////////////////////////////////////////////////////////// -->
            <?php if ( is_page_template( 'page-blank.php' ) ) {
                // kein Menu auf der blank-page
            } else {
                if ( is_active_sidebar( 'footer-widget-area' ) ) { ?> <!-- Widgets werden angezeigt -->
                    <div class="footer-widgets">
                        <?php dynamic_sidebar( 'footer-widget-area' ); ?>
                    </div> <!-- /footer-widgets -->
                <?php } else { ?> 
                <!-- keine Widgets im Footer -->
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
                                <?php
                                if (!empty($tocki_redux_themeoptions["tocki_redux_firma"])) { 
                                    echo $tocki_redux_themeoptions["tocki_redux_firma"]; echo " // ";
                                }
                                    
                                if (!empty($tocki_redux_themeoptions["tocki_redux_firma_zusatz"])) {
                                    echo $tocki_redux_themeoptions["tocki_redux_firma_zusatz"]; echo " // ";
                                }

                                if (!empty($tocki_redux_themeoptions["tocki_redux_strasse"])) { 
                                    echo $tocki_redux_themeoptions["tocki_redux_strasse"];
                                    echo " // ";
                                };

                                if (!empty($tocki_redux_themeoptions["tocki_redux_plz"])) { 
                                    echo $tocki_redux_themeoptions["tocki_redux_plz"]; 
                                };

                                if (!empty($tocki_redux_themeoptions["tocki_redux_ort"])) { 
                                    echo $tocki_redux_themeoptions["tocki_redux_ort"]; 
                                } 
                                echo " // "; ?>
                                Tel.: <span>{regiohelden.proxy.number}</span> // 
                                <a class="open-close" href="javascript:void(0);">Impressum</a> // 
                                <a class="datenschutz-open-close" href="javascript:void(0);">Datenschutz</a>
                            </div> <!-- /footer-links -->
                        <?php } ?>
                            
                        <div class="footer-rechts">
                            <?php if ($tocki_redux_themeoptions['tocki_redux_whitelabel'] == 1) { ?><!-- nichts -->
                            <?php } elseif ($tocki_redux_themeoptions['tocki_redux_whitelabel'] == 2) { ?>
                                <a href="http://www.regiohelden.de">Lokale Internetwerbung</a> von den 
                                <a href="http://www.regiohelden.de">RegioHelden</a>
                            <?php } elseif ($tocki_redux_themeoptions['tocki_redux_whitelabel'] == 3) { ?><!-- Marcapo -->
                            <?php } elseif ($tocki_redux_themeoptions['tocki_redux_whitelabel'] == 4) { ?>
                                Präsentiert von <a href="http://unser-stuttgart.de" target="_blank">Unser-Stuttgart.de</a><!-- Stuttgarter Zeitung -->
                            <?php } else { ?><!-- unknown whitelabel -->
                            <?php } ?>
                        </div> <!-- /footer-rechts -->
                        
                        <div class="clear"></div>
                        
                        <div id="impressum">
                            <?php if ( is_active_sidebar( 'impressum-widget-area' ) ) { ?> <!-- Widgets werden angezeigt -->
                                <?php dynamic_sidebar( 'impressum-widget-area' ); ?>
                            <?php } else { ?> <!-- Daten aus Theme Optionen werden angezeigt -->
                                <div class="impressum-box" itemscope itemtype="http://schema.org/LocalBusiness">
                                    <?php 
                                    if (!empty($tocki_redux_themeoptions["tocki_redux_impressum1_switcher"])) { 
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
                                            <?php  }

                                            if (!empty($tocki_redux_themeoptions["tocki_redux_ort"])) { ?>
                                                <span itemprop="addressLocality"><?php echo nl2br($tocki_redux_themeoptions["tocki_redux_ort"]);?></span><br>
                                            <?php } ?>
                                        </div>
                                        <br>
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

                            <div class="clear"></div>
                            
                            <div class="schliessen" style="font-size:11px;">
                                <a class="open-close" href="javascript:void(0);">Schlie&szlig;en</a>
                            </div>

                            <div class="clear"></div>
                        </div> <!-- /impressum -->
                        
                        <div class="clear"></div>
                        
                        <?php if ( is_active_sidebar( 'datenschutz-widget-area' ) ) { ?> <!-- Widgets werden angezeigt -->
                            <div id="datenschutz">  <!-- Beginn Datenschutz  --> 
                                <?php dynamic_sidebar( 'datenschutz-widget-area' ); ?>
                                <span style="font-size:11px; margin-left: 850px;"><a class="datenschutz-open-close" href="javascript:void(0);">Schlie&szlig;en</a></span>
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
                            </div>  <!-- Ende Datenschutz  --> 
                        <?php } ?>
                    </div> <!-- /footer -->
                        
                    <div class="clear"></div>
                </div> <!-- Ende footer-wrapper   -->
            <?php } ?>
        </div>
        <!-- /wrapper -->

        <?php wp_footer(); ?>

        <?php
        if (!empty($tocki_redux_themeoptions["tocki_redux_code_footer"])) { 
            echo $tocki_redux_themeoptions["tocki_redux_code_footer"];
        }

        edit_post_link(); ?>
       
        <nav id="mmenu">
            <?php 
            // template abfrage
            if ( is_page_template( 'page-adwords.php' ) ) {
                adwords_mws_mobile_nav();
            } else { 
                mws_mobile_nav();
            } 
            ?>
        </nav> 

        <!-- JavaScript im Footer -->
        <!-- individuelles Scripts der Seite  -->
        <script>
            var $ = jQuery,
                clickConv = '<?php !empty($tocki_redux_themeoptions["tocki_redux_formular_conversion_switcher"]) ? $tocki_redux_themeoptions["tocki_redux_formular_conversion_conversion_id"] : "" ?>',
                logged = '<?php is_user_logged_in(); ?>',
                google_conversion_id = '<?php if (!empty($tocki_redux_themeoptions["tocki_redux_formular_conversion_conversion_id"])) { echo $tocki_redux_themeoptions["tocki_redux_formular_conversion_conversion_id"]; } ?>',
                google_conversion_label = '<?php if (!empty($tocki_redux_themeoptions["tocki_redux_formular_conversion_conversion_label"])) { echo $tocki_redux_themeoptions["tocki_redux_formular_conversion_conversion_label"]; } ?>';
        
            (function (d, s, id) {
                var t, js, mws = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); 
                js.id = id;
                js.async = 'async';
                js.src = '<?php bloginfo("stylesheet_directory"); ?>/js/rh-mws.js';
                mws.parentNode.insertBefore(js, mws);
            }(document, 'script', 'rh-mws'));

            // parsley //////////////////////////////////////
            window.ParsleyConfig = window.ParsleyConfig || {};
            (function ($) {
              window.ParsleyConfig = $.extend(true, {}, window.ParsleyConfig, {
                    messages: {
                        defaultMessage: "Die Eingabe scheint nicht korrekt zu sein.", 
                        type: {
                            email:      "Die Eingabe muss eine gültige E-Mail-Adresse sein.",
                            url:        "Die Eingabe muss eine gültige URL sein.",
                            urlstrict:  "Die Eingabe muss eine gültige URL sein.",
                            number:     "Die Eingabe muss eine Zahl sein.",
                            digits:     "Die Eingabe darf nur Ziffern enthalten.",
                            dateIso:    "Die Eingabe muss ein gültiges Datum im Format YYYY-MM-DD sein.",
                            alphanum:   "Die Eingabe muss alphanumerisch sein.",
                            phone:      "Die Eingabe muss eine gültige Telefonnummer sein."
                        }, 
                        notnull:        "Die Eingabe darf nicht leer sein.",
                        notblank:       "Die Eingabe darf nicht leer sein.",
                        required:       "Dies ist ein Pflichtfeld.",
                        regexp:         "Die Eingabe scheint ungültig zu sein.",
                        min:            "Die Eingabe muss größer oder gleich %s sein.",
                        max:            "Die Eingabe muss kleiner oder gleich %s sein.",
                        range:          "Die Eingabe muss zwischen %s und %s liegen.",
                        minlength:      "Die Eingabe ist zu kurz. Es müssen mindestens %s Zeichen eingegeben werden.",
                        maxlength:      "Die Eingabe ist zu lang. Es dürfen höchstens %s Zeichen eingegeben werden.",
                        rangelength:    "Die Länge der Eingabe ist ungültig. Es müssen zwischen %s und %s Zeichen eingegeben werden.",
                        equalto:        "Dieses Feld muss dem anderen entsprechen.",
                        minwords:       "Die Eingabe muss mindestens %s Wörter enthalten.", 
                        maxwords:       "Die Eingabe darf höchstens %s Wörter enthalten.", 
                        rangewords:     "Die Eingabe muss zwischen %s und %s Wörter enthalten.", 
                        greaterthan:    "Die Eingabe muss größer als %s sein.", 
                        lessthan:       "Die Eingabe muss kleiner als %s sein."
                    }
                });
            }(window.jQuery || window.Zepto));
        </script>
        
        <?php
        if ( !empty($tocki_redux_themeoptions["tocki_redux_footer"]) ) {
            echo $tocki_redux_themeoptions["tocki_redux_footer"];
        } ?>
	</body>
</html>