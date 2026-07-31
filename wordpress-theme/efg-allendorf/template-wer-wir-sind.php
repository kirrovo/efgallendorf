<?php
/**
 * Template Name: Wer wir sind
 *
 * @package EFG_Allendorf
 */

get_header();

get_template_part( 'template-parts/page-hero', null, array(
	'title'    => 'Wer wir sind',
	'subtitle' => 'Eine Gemeinschaft von Menschen, die nach Gott fragen, seit 1884 in Allendorf.',
	'badge'    => 'Unsere Gemeinde',
	'crumbs'   => array( array( 'label' => 'Wer wir sind' ) ),
) );

$photo = get_template_directory_uri() . '/assets/img/gemeinde.jpg';
?>

<section class="section">
	<div class="section-inner">

		<div class="wws-intro">
			<img src="<?php echo esc_url( $photo ); ?>" alt="Gemeinde EFG Allendorf" />
			<div class="wws-intro-text">
				<span class="badge">Seit 1884</span>
				<p>Die Evangelische Freie Gemeinde Allendorf ist eine freie christliche Gemeinde, die ihre Wurzeln in der Gemeinschaftsbewegung hat und seit <strong>1884</strong> besteht.</p>
				<p>Wir sind eine Gruppe von Menschen aller Altersgruppen mit unterschiedlichen Hintergründen, Berufen und Lebensstilen, die nach Gott fragen und in einer persönlichen Beziehung zu Jesus Christus leben wollen.</p>
				<p>Im Glauben an Jesus Christus sehen wir die Antwort auf die Frage nach dem Sinn und Ziel unseres Lebens.</p>
			</div>
		</div>

		<div class="history-bar">
			<div class="history-year">1884</div>
			<p>Seit über 140 Jahren ist die Evangelische Freie Gemeinde Allendorf ein fester Teil der Gemeinschaft in Greifenstein-Allendorf. Was als Gemeinschaftsbewegung begann, ist heute eine lebendige Ortsgemeinde mit Menschen aus der ganzen Region.</p>
		</div>

		<div class="wws-glauben">
			<h2><?php efga_ico( 'buch' ); ?> Wir glauben</h2>
			<ul>
				<li>dass die Bibel Gottes Wort ist</li>
				<li>dass die Erde Gottes Schöpfung ist</li>
				<li>dass Gott in Jesus Mensch geworden ist</li>
				<li>dass Jesus für die Sünden der Menschen am Kreuz gestorben ist</li>
				<li>dass Jesus von den Toten auferweckt wurde</li>
				<li>dass Jesus Christus alle Macht in der sichtbaren und unsichtbaren Welt von seinem Vater übergeben wurde</li>
				<li>dass alles unter seiner Kontrolle ist</li>
				<li>dass allein der Glaube an Jesus Zugang zu Gott ermöglicht</li>
				<li>dass Gott uns seinen Heiligen Geist gibt</li>
				<li>dass die Gemeinschaft mit Gott unser Leben verändert</li>
				<li>dass Jesus uns Leben über den Tod hinaus schenkt</li>
				<li>dass Jesus wiederkommt und seine Herrschaft für alle Menschen sichtbar wird</li>
			</ul>
			<div class="darum">Darum gehen wir hoffnungsvoll in die Zukunft!</div>
		</div>

		<div class="wws-sections">
			<div class="wws-card">
				<h2><?php efga_ico( 'herz' ); ?>Wir möchten …</h2>
				<ul>
					<li>dass alle Menschen durch Jesus Christus Versöhnung mit Gott finden</li>
					<li>Gott anbeten</li>
					<li>miteinander lernen, ein Leben nach den Maßstäben der Bibel zu führen</li>
					<li>einander lieben, wie Gott uns liebt</li>
					<li>unseren Mitmenschen dienen</li>
				</ul>
			</div>
			<div class="wws-card">
				<h2><?php efga_ico( 'personen' ); ?>Wir treffen uns …</h2>
				<ul>
					<li>um Gott in gemeinsamen Liedern und Gebeten zu loben</li>
					<li>um mit Gott im Gebet auch über unsere Alltagssorgen zu sprechen</li>
					<li>um Gemeinschaft miteinander zu haben</li>
					<li>um die Bibel besser kennen zu lernen</li>
					<li>um in der Predigt Orientierung und aktuelle Lebenshilfe zu bekommen</li>
					<li>in besonderen Stunden, um das Abendmahl zu feiern</li>
				</ul>
			</div>
		</div>

		<div class="wws-card" style="margin-bottom: 0;">
			<h2><?php efga_ico( 'ort' ); ?>Wir kommen zusammen in …</h2>
			<ul style="columns: 2; column-gap: 32px;">
				<li>Gottesdiensten</li>
				<li>Bibelgesprächskreisen</li>
				<li>Gebetskreisen</li>
				<li>Hauskreisen</li>
				<li>Jungscharen und Jugendkreisen</li>
			</ul>
		</div>

	</div>
</section>

<?php
get_footer();
