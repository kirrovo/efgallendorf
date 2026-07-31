<?php
/**
 * Kontaktbereich (Gemeinde-Infos + Formular).
 * Kontaktdaten sind per base64 vor Webcrawlern geschützt.
 *
 * @package EFG_Allendorf
 */
?>
<div class="kontakt-grid">
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

		<div class="leitung-liste" id="leitung">
			<h4>Gemeindeleitung</h4>
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

	<div class="kontakt-karte">
		<h3>Nachricht senden</h3>
		<?php
		// Hinweis: Für echten Versand ein Formular-Plugin (z. B. Contact Form 7) einbinden
		// und den folgenden Block durch den Plugin-Shortcode ersetzen.
		?>
		<form class="kontakt-form" action="#" method="post">
			<div class="feld">
				<label for="k-name">Name</label>
				<input type="text" id="k-name" name="name" autocomplete="name" required />
			</div>
			<div class="feld">
				<label for="k-mail">E-Mail</label>
				<input type="email" id="k-mail" name="email" autocomplete="email" required />
				<span class="hilfe">Damit wir dir antworten können.</span>
			</div>
			<div class="feld">
				<label for="k-betreff">Betreff</label>
				<select id="k-betreff" name="betreff">
					<option>Allgemeine Anfrage</option>
					<option>Besuch und Anfahrt</option>
					<option>Gruppen und Kreise</option>
					<option>Veranstaltungen</option>
					<option>Mitgliedschaft</option>
				</select>
			</div>
			<div class="feld">
				<label for="k-nachricht">Nachricht</label>
				<textarea id="k-nachricht" name="nachricht" required></textarea>
			</div>
			<button type="submit" class="btn btn-blau">Nachricht senden</button>
		</form>
	</div>
</div>
