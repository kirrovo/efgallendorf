<?php
/**
 * Kontaktbereich: Formular mittig, Gemeindedaten darunter.
 * Kontaktdaten sind per base64 vor Webcrawlern geschützt.
 *
 * @package EFG_Allendorf
 */
$zeige_kopf = ! isset( $args['kopf'] ) || $args['kopf'];
?>
<div class="kontakt-block">
	<?php if ( $zeige_kopf ) : ?>
	<span class="eyebrow">Kontakt</span>
	<h2>Schreib uns</h2>
	<p>
		Oder melde dich direkt bei uns unter
		<?php efga_email( 'info@eg-allendorf.de' ); ?>
	</p>
	<?php endif; ?>

	<?php
	// Hinweis: Für echten Versand ein Formular-Plugin (z. B. Contact Form 7) einbinden
	// und den folgenden Block durch den Plugin-Shortcode ersetzen.
	?>
	<form class="kontakt-form" action="#" method="post">
		<div class="feld">
			<label for="k-name">Name</label>
			<div class="feld-icon">
				<?php efga_ico( 'person' ); ?>
				<input type="text" id="k-name" name="name" autocomplete="name"
				       placeholder="Dein vollständiger Name" required />
			</div>
		</div>

		<div class="feld">
			<label for="k-mail">E-Mail-Adresse</label>
			<div class="feld-icon">
				<?php efga_ico( 'mail' ); ?>
				<input type="email" id="k-mail" name="email" autocomplete="email"
				       placeholder="Deine E-Mail-Adresse" required />
			</div>
			<span class="hilfe">Damit wir dir antworten können.</span>
		</div>

		<div class="feld">
			<label for="k-betreff">Betreff</label>
			<div class="feld-icon">
				<?php efga_ico( 'notiz' ); ?>
				<select id="k-betreff" name="betreff">
					<option>Allgemeine Anfrage</option>
					<option>Besuch und Anfahrt</option>
					<option>Gruppen und Kreise</option>
					<option>Veranstaltungen</option>
					<option>Mitgliedschaft</option>
				</select>
			</div>
		</div>

		<div class="feld">
			<label for="k-nachricht">Nachricht</label>
			<textarea id="k-nachricht" name="nachricht" rows="4"
			          placeholder="Deine Nachricht an uns" required></textarea>
		</div>

		<button type="submit" class="btn btn-blau btn-absenden">
			Nachricht senden
			<?php efga_ico( 'pfeil-rechts', 'ico-sm' ); ?>
		</button>
	</form>
</div>

<div class="kontakt-daten">
	<div class="kontakt-karte">
		<h3>Gemeinde-Informationen</h3>

		<div class="kontakt-zeile">
			<?php efga_ico( 'ort' ); ?>
			<div class="kontakt-zeile-text">
				<strong>Adresse</strong>
				Heimlingstraße 3<br />35753 Greifenstein-Allendorf
			</div>
		</div>
		<div class="kontakt-zeile">
			<?php efga_ico( 'mail' ); ?>
			<div class="kontakt-zeile-text">
				<strong>E-Mail</strong>
				<?php efga_email_text( 'info@eg-allendorf.de' ); ?>
			</div>
		</div>
		<div class="kontakt-zeile">
			<?php efga_ico( 'uhr' ); ?>
			<div class="kontakt-zeile-text">
				<strong>Gottesdienst</strong>
				Jeden Sonntag, 10:00 Uhr
			</div>
		</div>
	</div>

	<div class="kontakt-karte" id="leitung">
		<h3>Gemeindeleitung</h3>
		<div class="leitung-liste" style="margin-top: 0; padding-top: 0; border-top: none;">
			<?php
			$leitung = array(
				array( 'TE', 'Thomas Engelke', 'Pastor', '01573 / 535 34 71' ),
				array( 'FD', 'Florian Diehl', 'Gemeindeleitung', '06478 / 277 200' ),
				array( 'AG', 'Andreas Genz', 'Gemeindeleitung', '06478 / 277 99 11' ),
			);
			foreach ( $leitung as $person ) :
				?>
				<div class="person">
					<span class="person-avatar" aria-hidden="true"><?php echo esc_html( $person[0] ); ?></span>
					<div class="person-info">
						<strong><?php echo esc_html( $person[1] ); ?></strong>
						<span><?php echo esc_html( $person[2] ); ?>, <?php efga_phone_link( $person[3] ); ?></span>
					</div>
				</div>
				<?php
			endforeach;
			?>
		</div>
	</div>
</div>
