<?php
/**
 * Beispiel-Inhalte bei Theme-Aktivierung anlegen.
 * Legt Gruppen (CPT), Veranstaltungen (CPT) und die statischen Seiten an,
 * sofern sie noch nicht existieren. Läuft genau einmal pro Aktivierung.
 *
 * @package EFG_Allendorf
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function efga_seed_content() {

	/* ── 1. GRUPPEN ──────────────────────────────────── */
	$gruppen = array(
		array(
			'title'    => 'Gottesdienst',
			'slug'     => 'gottesdienst', 'bild_alt' => 'Leere Holzstühle in einem hellen Gemeindesaal',
			'short'    => 'Das Herzstück unseres Gemeindelebens: Lieder, Gebet und Gottes Wort. Einmal im Monat mit Abendmahl.',
			'content'  => '<p>Der wöchentliche Gottesdienst ist das Herzstück unseres Gemeindelebens. Hier kommen wir als Glaubensgeschwister zusammen, um gemeinsam zur Ruhe zu kommen, auf Gottes Wort zu hören und ihm in Form von Liedern und Gebeten zu antworten und ihn anzubeten.</p>

<p>Einmal im Monat feiern wir zudem das Abendmahl.</p>

<p>Im Gottesdienst wollen wir uns für die neue Woche ausrüsten lassen, um mit neuem Mut unseren Glauben im Alltag praktisch werden zu lassen.</p>',
			'icon'     => 'kirche', 'badge' => 'Ganze Gemeinde',
			'bereich'  => 'Gemeinde gemeinsam',
			'schedule' => 'Sonntags 10:00 Uhr', 'location' => 'Gemeindehaus Allendorf', 'audience' => 'Jeder ist willkommen',
			'subtitle' => 'Das Herzstück unseres Gemeindelebens.',
			'name'     => 'Gemeindeleitung', 'initials' => 'GL', 'phone' => '', 'email' => 'gemeindeleitung@eg-allendorf.de',
		),
		array(
			'title'    => 'Hauskreise',
			'slug'     => 'hauskreise', 'bild_alt' => 'Menschen sitzen abends bei Kerzenlicht um einen Esstisch',
			'short'    => 'Bunt gemischte Kleingruppen unter der Woche. Leben teilen, Nachfolge leben, im Glauben wachsen.',
			'content'  => '<p>Unsere Hauskreise sind verschiedene, bunt gemischte Kleingruppen, die sich regelmäßig unter der Woche treffen. Im Vordergrund steht der persönliche Austausch, ob über den normalen Alltag, über Glaubensfragen oder persönliche Anliegen.</p>

<p>Hauskreise bieten die Möglichkeit, bei lockerem Zusammensein intensive Gemeinschaft zu erleben, um sich gegenseitig im Glauben an Gott und in der Nachfolge Jesu zu schleifen und zu unterstützen. Wir wollen Leben teilen, Nachfolge leben und im Glauben wachsen.</p>

<p>Jeder ist herzlich eingeladen, Teil eines Hauskreises zu werden. Komm gerne auf uns zu.</p>',
			'icon'     => 'haus', 'badge' => 'Alle',
			'bereich'  => 'Gemeinde gemeinsam',
			'schedule' => 'Alle 14 Tage, nach Absprache', 'location' => 'Nach Absprache', 'audience' => 'Jeder ist willkommen',
			'subtitle' => 'Leben teilen. Nachfolge leben. Im Glauben wachsen.',
			'name'     => 'Gemeindeleitung', 'initials' => 'GL', 'phone' => '', 'email' => 'gemeindeleitung@eg-allendorf.de',
		),
		array(
			'title'    => 'GLV: Glauben, Leben, Verstehen',
			'slug'     => 'glv', 'bild_alt' => 'Hände machen Notizen neben aufgeschlagenen Büchern und einer Tasse Kaffee',
			'short'    => 'Alle vierzehn Tage denken wir über Glaubensfragen nach, mit Raum für Diskussion und Austausch.',
			'content'  => '<p>Als gesamte Gemeinde treffen wir uns neben dem Gottesdienst alle vierzehn Tage zur GLV, um über verschiedene Glaubensfragen intensiv nachzudenken und unseren Glauben aktiv zu leben. Gemeinsam wollen wir Glauben leben und verstehen.</p>

<p>Hier behandeln wir aktuelle, lebensnahe und theologische Themen auf der Grundlage der Bibel. Dabei haben wir die Möglichkeit für Diskussion und Austausch.</p>

<p>Daneben nehmen wir uns regelmäßig die Zeit, füreinander und für die Anliegen der Gemeinde zu beten.</p>',
			'icon'     => 'buch', 'badge' => 'Ganze Gemeinde',
			'bereich'  => 'Gemeinde gemeinsam',
			'schedule' => 'Mittwochs, alle 14 Tage', 'location' => 'Gemeindehaus Allendorf', 'audience' => 'Jeder ist willkommen',
			'subtitle' => 'Gemeinsam über Glaubensfragen nachdenken und den Glauben aktiv leben.',
			'name'     => 'Simon Droß', 'initials' => 'SD', 'phone' => '06478 / 911 638', 'email' => 'simon.dross@eg-allendorf.de',
		),
		array(
			'title'    => 'Bibelstunde',
			'slug'     => 'bibelstunde', 'bild_alt' => 'Aufgeschlagene Bibel mit lesbaren Textseiten',
			'short'    => 'Gemeinsam singen, in der Bibel lesen und die Botschaft in den Alltag übertragen.',
			'content'  => '<p>Die Bibelstunde trifft sich regelmäßig, um gemeinsam zu singen, in der Bibel zu lesen und sich zusammen über das Wort Gottes auszutauschen.</p>

<p>Unser gemeinsames Ziel ist es, die Botschaft der Bibel besser zu verstehen und sie auch in unseren Alltag zu übertragen.</p>

<h2>Was machen wir?</h2>
<ul><li>Uns mit biblischen Büchern beschäftigen</li><li>Die biblischen Texte gemeinsam erarbeiten</li><li>Zusammen beten</li><li>Gemeinsam singen</li></ul>',
			'icon'     => 'notiz', 'badge' => 'Jedes Alter',
			'bereich'  => 'Gemeinde gemeinsam',
			'schedule' => 'Mittwochs, alle 14 Tage', 'location' => 'Gemeindehaus Allendorf', 'audience' => 'Für jedes Alter geeignet',
			'subtitle' => 'Zeit zum Bibellesen, zum gemeinsamen Austausch und zum Verstehen biblischer Texte.',
			'name'     => 'Simon Droß', 'initials' => 'SD', 'phone' => '06478 / 911 638', 'email' => 'simon.dross@eg-allendorf.de',
		),
		array(
			'title'    => 'Seniorenarbeit',
			'slug'     => 'seniorenarbeit', 'bild_alt' => 'Mehrere Hände unterschiedlicher Generationen liegen übereinander',
			'short'    => 'Besuchsdienst und Seniorenkaffee mit Andacht, Gemeinschaft und Begleitung im Alltag.',
			'content'  => '<p>Die Seniorenarbeit bietet neben dem Besuchsdienst mit dem Seniorenkaffee dreimal im Jahr einen vielfältigen Treffpunkt für Menschen im und um das Ruhestandsalter an.</p>

<p>Dieses Angebot richtet sich gezielt an die Bedürfnisse und Interessen älter gewordener Menschen. Neben Kaffee und Kuchen und der gemeinsamen Andacht stehen Gemeinschaft, Begegnung, Austausch und auch Begleitung im Alltag im Mittelpunkt.</p>

<h2>Was machen wir?</h2>
<ul><li>Besuchsdienst und Unterstützung im Alltag</li><li>Gemütliches Kaffeetrinken</li><li>Gemeinsamer Austausch</li><li>Zusammen singen</li><li>Geistlicher Impuls</li></ul>',
			'icon'     => 'sonne', 'badge' => 'Ab dem Ruhestandsalter',
			'bereich'  => 'Frauen, Männer, Senioren',
			'schedule' => 'Seniorenkaffee 3x im Jahr', 'location' => 'Gemeindehaus Allendorf', 'audience' => 'Menschen im und um das Ruhestandsalter',
			'subtitle' => 'Begegnung, Austausch und Begleitung.',
			'name'     => 'Simon und Ulrike Droß', 'initials' => 'SD', 'phone' => '06478 / 911 638', 'email' => 'simon.dross@eg-allendorf.de',
		),
		array(
			'title'    => 'Kaffee und Müsli',
			'slug'     => 'kaffee-und-muesli', 'bild_alt' => 'Müslischale mit Beeren, Kaffee und Blüten auf einem hellen Tisch',
			'short'    => 'Das Frauenfrühstück der Gemeinde, mit Lobpreis, biblischem Impuls und persönlichem Austausch.',
			'content'  => '<p>Kaffee und Müsli ist ein regelmäßiges Frauenfrühstück für Frauen der Gemeinde. In gemütlicher Atmosphäre genießen wir gemeinsam ein Frühstück und haben Zeit für Lobpreis, einen biblischen Impuls, Gebet und persönlichen Austausch.</p>

<p>Mehrmals im Jahr findet zudem Kaffee und Müsli kreativ statt, ein offenes Angebot für Frauen aus unserer Gemeinde und der Umgebung. Bei einem gemeinsamen Frühstück, kreativen Workshops und lebensnahen Impulsen schaffen wir einen Ort der Begegnung, an dem Frauen Gemeinschaft erleben und Gott sowie den christlichen Glauben kennenlernen können.</p>

<p>Jede Frau ist herzlich willkommen, unabhängig davon, wo sie gerade auf ihrem Lebens- oder Glaubensweg steht.</p>',
			'icon'     => 'tasse', 'badge' => 'Frauen jeden Alters',
			'bereich'  => 'Frauen, Männer, Senioren',
			'schedule' => 'Samstags 9:00 Uhr, monatlich', 'location' => 'Gemeindehaus Allendorf', 'audience' => 'Frauen jeden Alters',
			'subtitle' => 'Das Frauenfrühstück unserer Gemeinde.',
			'name'     => 'Sibylle Rupp', 'initials' => 'SR', 'phone' => '0178 696 1961', 'email' => '',
		),
		array(
			'title'    => 'Frauengebetskreis',
			'slug'     => 'frauengebetskreis', 'bild_alt' => 'Gefaltete Hände auf einem hellen Tisch',
			'short'    => 'Wir beten für Anliegen von Gemeinde und Mission, singen, lesen in der Bibel und tauschen uns aus.',
			'content'  => '<p>Der Name ist Programm. Wir treffen uns als Frauen der Gemeinde, um für Anliegen von Gemeinde und Mission zu beten, getreu Philipper 4,6: „Bringt alle eure Anliegen im Gebet mit Bitte und Danksagung vor Gott.“</p>

<p>Neben dem Gebet singen wir, lesen in der Bibel und tauschen uns aus.</p>',
			'icon'     => 'herz', 'badge' => 'Frauen der Gemeinde',
			'bereich'  => 'Frauen, Männer, Senioren',
			'schedule' => 'Montags, alle 14 Tage', 'location' => 'Gemeindehaus Allendorf', 'audience' => 'Alle Frauen der Gemeinde',
			'subtitle' => 'Gebetstreff für Frauen der Gemeinde.',
			'name'     => 'Leni Klaus', 'initials' => 'LK', 'phone' => '', 'email' => '',
		),
		array(
			'title'    => 'Männertreffen',
			'slug'     => 'maennertreffen', 'bild_alt' => 'Lagerfeuer im Wald bei Tageslicht',
			'short'    => 'Mehrmals im Jahr: gutes Essen, Sport, Gespräche und Themen, die uns als Männer betreffen.',
			'content'  => '<p>Als Männer der Gemeinde wollen wir in allen Altersstufen miteinander verbunden sein. Dazu treffen wir uns mehrmals im Jahr, um bei ungezwungenem Zusammensein, gutem Essen, Sport sowie Gesprächen und Diskussionen echte Männergemeinschaft zu erleben.</p>

<p>Wir wollen uns gegenseitig in unserem Glauben an Gott stärken. Dafür denken wir besonders über die Themen nach, die uns als Männer in unserem Alltag und Glaubensleben in besonderer Weise betreffen.</p>

<p>Zu unseren Treffen sind alle Männer jeden Alters herzlich eingeladen.</p>

<h2>Nächste Treffen</h2>
<ul><li>Männerfrühstück am 26. September 2026 um 9:00 Uhr</li><li>Männerwandern zwischen den Jahren</li></ul>',
			'icon'     => 'personen', 'badge' => 'Männer jeden Alters',
			'bereich'  => 'Frauen, Männer, Senioren',
			'schedule' => 'Quartalsweise', 'location' => 'Gemeindehaus Allendorf', 'audience' => 'Männer jeden Alters',
			'subtitle' => 'Echte Gemeinschaft unter Männern.',
			'name'     => 'Lars Rupp', 'initials' => 'LR', 'phone' => '', 'email' => 'lars.rupp@eg-allendorf.de',
		),
		array(
			'title'    => 'Crossroad',
			'slug'     => 'crossroad', 'bild_alt' => 'Zwei Jugendliche sitzen bei Sonnenuntergang auf einer Mauer',
			'short'    => 'Unser Teen- und Jugendkreis. Alltag teilen, Freundschaft leben, über Gott nachdenken.',
			'content'  => '<p>Der Crossroad ist unser wöchentlicher Teen- und Jugendkreis. Hier geht es um echte Gemeinschaft unter jungen Menschen, ob bei lockerem Zusammensein, bei Spiel und Spaß oder verschiedenen Aktionen. Wir wollen unseren Alltag miteinander teilen und echte Freundschaften leben.</p>

<p>Wir nehmen uns Zeit, um zu singen und in der Bibel zu lesen, über Gott nachzudenken und zu fragen, welche Bedeutung der Glaube an Gott für unser Leben und unseren Alltag hat.</p>

<p>Jeder ist herzlich willkommen, dazuzukommen. Nimm gerne Kontakt mit uns auf.</p>',
			'icon'     => 'kompass', 'badge' => 'Teens ab dem 8. Schuljahr',
			'bereich'  => 'Kinder und Jugend',
			'schedule' => 'Freitags 19:00 Uhr', 'location' => 'Gemeindehaus Allendorf', 'audience' => 'Teens und Jugendliche ab dem 8. Schuljahr',
			'subtitle' => 'Glauben entdecken. Alltag teilen. Freundschaft leben.',
			'name'     => 'Thomas Engelke', 'initials' => 'TE', 'phone' => '', 'email' => 'thomas.engelke@eg-allendorf.de',
		),
		array(
			'title'    => 'Wilde Füchse: Jungschar',
			'slug'     => 'wilde-fuechse', 'bild_alt' => 'Zwei Kinder mit Rucksäcken laufen über einen Waldweg',
			'short'    => 'Musik, Spiele, Ausflüge und biblische Geschichten. Jährliches Highlight ist die Kinderfreizeit.',
			'content'  => '<p>Wir sind Kinder, die in die 4. bis 7. Klasse gehen. Jeden Dienstag treffen wir uns, um gemeinsam Musik zu machen, zu singen, uns zu bewegen, zu spielen, gemeinsam zu essen, Ausflüge zu machen und jede Menge Spaß zu haben.</p>

<p>Außerdem ist uns die Bibel ein sehr wichtiges Buch, aus der wir regelmäßig Geschichten hören. Dabei erfahren wir, dass es einen Gott gibt, der uns geschaffen hat, der uns bedingungslos liebt und dem wir unendlich wertvoll sind.</p>

<p>Als Mitarbeiterteam möchten wir für unsere Jungscharkinder immer ein offenes Ohr haben und für sie da sein. Wir möchten ihnen etwas von unserem Glauben an Gott und seinen Sohn Jesus Christus weitergeben, damit sie Gott selbst für ihr Leben kennenlernen.</p>

<h2>Highlight im Jahr</h2>
<ul><li>Unsere jährliche Kinderfreizeit in Rodenroth, nächster Termin 3. bis 5. September 2027</li></ul>',
			'icon'     => 'stern', 'badge' => '4. bis 7. Schuljahr',
			'bereich'  => 'Kinder und Jugend',
			'schedule' => 'Dienstags 17:00 Uhr', 'location' => 'Gemeindehaus, Heimlingstraße 3', 'audience' => 'Kinder ab dem 4. bis einschließlich 7. Schuljahr',
			'subtitle' => 'Gemeinschaft, Glaube und jede Menge Action.',
			'name'     => 'Ulrike Droß', 'initials' => 'UD', 'phone' => '', 'email' => 'uli.dross@eg-allendorf.de',
		),
		array(
			'title'    => 'Knallerbsen: Jungschar',
			'slug'     => 'knallerbsen', 'bild_alt' => 'Kinderhände malen mit Wachsmalstiften ein Bild',
			'short'    => 'Spannende Geschichten aus der Bibel, singen, spielen, basteln und backen.',
			'content'  => '<p>Die Knallerbsen sind eine Jungschargruppe für Kinder ab 5 Jahren. Jede Woche hören wir spannende Geschichten aus der Bibel und entdecken darin, wie sehr Gott uns liebt.</p>

<p>Bei uns wird gesungen, gespielt und gelacht, ob drinnen oder draußen, beim Basteln oder Backen.</p>

<p>Wenn du Lust auf Spiele, Spaß und spannende Geschichten hast, komm gerne einfach vorbei. Wir freuen uns auf dich.</p>',
			'icon'     => 'pflanze', 'badge' => 'Ab 5 Jahren',
			'bereich'  => 'Kinder und Jugend',
			'schedule' => 'Donnerstags 16:15 Uhr', 'location' => 'Gemeindehaus Allendorf', 'audience' => 'Kinder ab 5 Jahren bis einschließlich 3. Schuljahr',
			'subtitle' => 'Spiel, Spaß und spannende biblische Geschichten.',
			'name'     => 'Miriam Diehl', 'initials' => 'MD', 'phone' => '06478 / 277 200', 'email' => 'miriam.diehl@eg-allendorf.de',
		),
		array(
			'title'    => 'Kindergottesdienst',
			'slug'     => 'kindergottesdienst', 'bild_alt' => 'Kind malt mit einem Pinsel auf einem Blatt Papier',
			'short'    => 'Fröhliche Lieder, Geschichten aus der Bibel und ein erlebnisreiches Bastel- und Spieleprogramm.',
			'content'  => '<p>Wir sind eine bunt gemischte Gruppe, die gemeinsam wertvolle Zeit verbringt.</p>

<p>Im Kindergottesdienst erwarten dich fröhliche Lieder, Geschichten und kindgerecht gestaltete Impulse aus der Bibel sowie ein erlebnisreiches Bastel- und Spieleprogramm.</p>

<h2>Besondere Highlights</h2>
<ul><li>Unser Sommerfest</li><li>Das Weihnachtsanspiel, das wir zusammen an Weihnachten aufführen</li></ul>',
			'icon'     => 'note', 'badge' => 'Kinder von 3 bis 12',
			'bereich'  => 'Kinder und Jugend',
			'schedule' => 'Sonntags 10:30 Uhr', 'location' => 'Gemeindehaus Allendorf', 'audience' => 'Kinder ab 3 bis 12 Jahren',
			'subtitle' => 'Hören, vertrauen, wachsen.',
			'name'     => 'Ricarda Genz', 'initials' => 'RG', 'phone' => '06478 / 277 99 11', 'email' => 'ricarda.genz@web.de',
		),
		array(
			'title'    => 'Biblischer Unterricht',
			'slug'     => 'biblischer-unterricht', 'bild_alt' => 'Aufgeschlagenes Buch mit Notizheften und Stiften auf einem Tisch',
			'short'    => 'Eineinhalb Jahre in fester Gruppe auf der Suche: Was ist die Bibel? Wer ist Gott?',
			'content'  => '<p>Im biblischen Unterricht treffen wir uns für eineinhalb Jahre in einer festen Gruppe, um gemeinsam auf die Suche zu gehen: Was ist die Bibel? Wer ist Gott? Wer sind wir Menschen? Warum gibt es die Gemeinde?</p>

<p>Unser Motto: „Die Bibel ist eine zusammenhängende Geschichte, die zu Jesus führt und uns zeigt, wer Gott ist, wer wir Menschen sind und wie wir Menschen mit diesem Gott leben können.“ Diese Geschichte zu entdecken und zu verstehen, welche Bedeutung sie für unser Leben hat, ist das Ziel vom BU.</p>

<p>Neben unseren regelmäßigen Treffen dürfen die Kinder und Teens sich auf weitere Aktionen, Mitarbeit in Gemeinde und Gottesdiensten sowie eine viertägige Abschlussfreizeit freuen.</p>',
			'icon'     => 'lupe', 'badge' => '6. und 7. Schuljahr',
			'bereich'  => 'Kinder und Jugend',
			'schedule' => 'Freitags, alle 14 Tage', 'location' => 'Gemeindehaus Allendorf', 'audience' => 'Kinder im 6. und 7. Schuljahr',
			'subtitle' => 'Gemeinsam auf der Suche.',
			'name'     => 'Thomas Engelke', 'initials' => 'TE', 'phone' => '', 'email' => 'thomas.engelke@eg-allendorf.de',
		),
		// Nicht im Textdokument REV0 enthalten, aus dem Altbestand übernommen.
		array(
			'title'    => 'Kreisjugend',
			'slug'     => 'kreisjugend',
			'short'    => 'Singles und junge Ehepaare treffen sich für Gemeinschaft, Glauben und gemeinsame Erlebnisse.',
			'content'  => '<p>Singles und junge Ehepaare treffen sich alle vierzehn Tage für Gemeinschaft, Glauben und gemeinsame Erlebnisse.</p>',
			'icon'     => 'funke', 'badge' => 'Junge Erwachsene',
			'bereich'  => 'Kinder und Jugend',
			'schedule' => 'Alle 14 Tage', 'location' => 'Gemeindehaus Allendorf', 'audience' => 'Junge Erwachsene',
			'subtitle' => 'Gemeinschaft für Singles und junge Ehepaare.',
			'name'     => 'Andreas Genz', 'initials' => 'AG', 'phone' => '06478 / 277 533', 'email' => 'andy.genz@eg-allendorf.de',
		),
	);

	$order = 0;
	foreach ( $gruppen as $g ) {
		if ( get_page_by_path( $g['slug'], OBJECT, 'gruppe' ) ) {
			continue; // existiert bereits.
		}
		$id = wp_insert_post( array(
			'post_type'    => 'gruppe',
			'post_status'  => 'publish',
			'post_title'   => $g['title'],
			'post_name'    => $g['slug'],
			'post_content' => $g['content'],
			'menu_order'   => $order++,
		) );
		if ( $id && ! is_wp_error( $id ) ) {
			update_post_meta( $id, 'efga_icon', $g['icon'] );
			update_post_meta( $id, 'efga_badge', $g['badge'] );
			update_post_meta( $id, 'efga_bereich', $g['bereich'] );
			update_post_meta( $id, 'efga_schedule', $g['schedule'] );
			update_post_meta( $id, 'efga_location', $g['location'] );
			update_post_meta( $id, 'efga_audience', $g['audience'] );
			update_post_meta( $id, 'efga_hero_subtitle', $g['subtitle'] );
			update_post_meta( $id, 'efga_short', $g['short'] );
			if ( ! empty( $g['bild_alt'] ) ) { update_post_meta( $id, 'efga_bild_alt', $g['bild_alt'] ); }
			update_post_meta( $id, 'efga_leader_name', $g['name'] );
			update_post_meta( $id, 'efga_leader_initials', $g['initials'] );
			update_post_meta( $id, 'efga_leader_phone', $g['phone'] );
			update_post_meta( $id, 'efga_leader_email', $g['email'] );
		}
	}

	/* ── 2. VERANSTALTUNGEN ──────────────────────────── */
	$events = array(
		array( 'title' => 'Bibeltage 2026', 'day' => '03', 'month' => 'Mai', 'time' => 'Sonntag bis Mittwoch, 10:00 und 19:30 Uhr', 'tag' => 'Bibeltage', 'content' => '„Auf und nieder, immer wieder": vier Abende aus dem Leben Davids. Referent: Markus Wäsch.' ),
		array( 'title' => 'Sonntagsgottesdienst', 'day' => '11', 'month' => 'Mai', 'time' => 'Sonntag, 10:00 Uhr', 'tag' => 'Gottesdienst', 'content' => 'Wöchentlicher Gottesdienst mit Predigt, Lobpreis und Gemeinschaft. Kinder- und Jugendprogramm parallel.' ),
		array( 'title' => 'Gemeindeabend', 'day' => '17', 'month' => 'Mai', 'time' => 'Samstag, 19:00 Uhr', 'tag' => 'Gemeinschaft', 'content' => 'Ein Abend zum Miteinander: Austausch, Gebet und gemeinsames Essen. Alle sind herzlich willkommen.' ),
	);
	$order = 0;
	foreach ( $events as $e ) {
		$existing = get_posts( array( 'post_type' => 'veranstaltung', 'title' => $e['title'], 'numberposts' => 1, 'post_status' => 'any' ) );
		if ( $existing ) { continue; }
		$id = wp_insert_post( array(
			'post_type'    => 'veranstaltung',
			'post_status'  => 'publish',
			'post_title'   => $e['title'],
			'post_content' => $e['content'],
			'menu_order'   => $order++,
		) );
		if ( $id && ! is_wp_error( $id ) ) {
			update_post_meta( $id, 'efga_date_day', $e['day'] );
			update_post_meta( $id, 'efga_date_month', $e['month'] );
			update_post_meta( $id, 'efga_time', $e['time'] );
			update_post_meta( $id, 'efga_tag', $e['tag'] );
		}
	}

	/* ── 3. SEITEN (mit Templates) ───────────────────── */
	$pages = array(
		array( 'title' => 'Wer wir sind',        'slug' => 'wer-wir-sind',      'template' => 'template-wer-wir-sind.php' ),
		array( 'title' => 'Gottesdienst Live',   'slug' => 'gottesdienst-live', 'template' => 'template-live.php' ),
		array( 'title' => 'Kalender',            'slug' => 'kalender',          'template' => 'template-kalender.php' ),
		array( 'title' => 'Interner Bereich',    'slug' => 'intern',            'template' => 'template-intern.php' ),
		array( 'title' => 'Kontakt & Anfahrt',   'slug' => 'kontakt',           'template' => 'template-kontakt.php' ),
		array( 'title' => 'Impressum',           'slug' => 'impressum',         'template' => 'template-impressum.php' ),
		array( 'title' => 'Datenschutzerklärung','slug' => 'datenschutz',       'template' => 'template-datenschutz.php' ),
	);
	foreach ( $pages as $p ) {
		if ( get_page_by_path( $p['slug'] ) ) { continue; }
		$id = wp_insert_post( array(
			'post_type'   => 'page',
			'post_status' => 'publish',
			'post_title'  => $p['title'],
			'post_name'   => $p['slug'],
		) );
		if ( $id && ! is_wp_error( $id ) ) {
			update_post_meta( $id, '_wp_page_template', $p['template'] );
		}
	}

	/* ── 4. STARTSEITE festlegen ─────────────────────── */
	if ( ! get_page_by_path( 'startseite' ) ) {
		$home_id = wp_insert_post( array(
			'post_type'   => 'page',
			'post_status' => 'publish',
			'post_title'  => 'Startseite',
			'post_name'   => 'startseite',
		) );
		if ( $home_id && ! is_wp_error( $home_id ) ) {
			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $home_id );
		}
	}

	/* ── 5. Hauptmenü anlegen & zuweisen ─────────────── */
	$menu_name = 'Hauptnavigation';
	if ( ! wp_get_nav_menu_object( $menu_name ) ) {
		$menu_id = wp_create_nav_menu( $menu_name );
		if ( ! is_wp_error( $menu_id ) ) {
			wp_update_nav_menu_item( $menu_id, 0, array( 'menu-item-title' => 'Home', 'menu-item-url' => home_url( '/' ), 'menu-item-status' => 'publish' ) );
			$wer = get_page_by_path( 'wer-wir-sind' );
			if ( $wer ) { wp_update_nav_menu_item( $menu_id, 0, array( 'menu-item-title' => 'Wer wir sind', 'menu-item-object' => 'page', 'menu-item-object-id' => $wer->ID, 'menu-item-type' => 'post_type', 'menu-item-status' => 'publish' ) ); }
			wp_update_nav_menu_item( $menu_id, 0, array( 'menu-item-title' => 'Gruppen', 'menu-item-url' => get_post_type_archive_link( 'gruppe' ), 'menu-item-status' => 'publish' ) );
			$live = get_page_by_path( 'gottesdienst-live' );
			if ( $live ) { wp_update_nav_menu_item( $menu_id, 0, array( 'menu-item-title' => 'Live', 'menu-item-object' => 'page', 'menu-item-object-id' => $live->ID, 'menu-item-type' => 'post_type', 'menu-item-status' => 'publish', 'menu-item-classes' => 'nav-live' ) ); }
			$kal = get_page_by_path( 'kalender' );
			if ( $kal ) { wp_update_nav_menu_item( $menu_id, 0, array( 'menu-item-title' => 'Kalender', 'menu-item-object' => 'page', 'menu-item-object-id' => $kal->ID, 'menu-item-type' => 'post_type', 'menu-item-status' => 'publish' ) ); }
			$intern = get_page_by_path( 'intern' );
			if ( $intern ) { wp_update_nav_menu_item( $menu_id, 0, array( 'menu-item-title' => 'Intern', 'menu-item-object' => 'page', 'menu-item-object-id' => $intern->ID, 'menu-item-type' => 'post_type', 'menu-item-status' => 'publish', 'menu-item-classes' => 'nav-intern' ) ); }

			$locations            = get_theme_mod( 'nav_menu_locations' );
			$locations['primary'] = $menu_id;
			set_theme_mod( 'nav_menu_locations', $locations );
		}
	}

	/* ── 6. Permalinks neu schreiben ─────────────────── */
	efga_register_cpts();
	flush_rewrite_rules();
}
