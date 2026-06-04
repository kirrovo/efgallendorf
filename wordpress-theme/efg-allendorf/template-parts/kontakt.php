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
			<div class="kontakt-zeile-icon"><svg width="16" height="16" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg></div>
			<div class="kontakt-zeile-text"><strong>Adresse</strong>Heimlingstraße 3<br>35753 Greifenstein Allendorf</div>
		</div>
		<div class="kontakt-zeile">
			<div class="kontakt-zeile-icon"><svg width="16" height="16" viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg></div>
			<div class="kontakt-zeile-text"><strong>E-Mail</strong><?php efga_email_text( 'info@eg-allendorf.de' ); ?></div>
		</div>
		<div class="kontakt-zeile">
			<div class="kontakt-zeile-icon"><svg width="16" height="16" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 14.5v-9l6 4.5-6 4.5z"/></svg></div>
			<div class="kontakt-zeile-text"><strong>Gottesdienst</strong>Jeden Sonntag · 10:00 Uhr</div>
		</div>
		<div style="margin-top:20px;padding-top:16px;border-top:1px solid #e8ecf5;">
			<div class="section-kicker" style="margin-bottom:10px;">Gemeindeleitung</div>
			<div style="display:flex;flex-direction:column;gap:10px;">
				<div style="display:flex;gap:10px;align-items:center;">
					<div style="width:38px;height:38px;background:var(--blau-sehr-hell);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:.75rem;font-weight:700;color:var(--blau);flex-shrink:0;">TE</div>
					<div><strong style="font-size:.88rem;display:block;">Thomas Engelke</strong><span style="font-size:.78rem;color:var(--grau-mittel);">Pastor · <?php efga_phone_text( '01573 / 535 34 71' ); ?></span></div>
				</div>
				<div style="display:flex;gap:10px;align-items:center;">
					<div style="width:38px;height:38px;background:var(--blau-sehr-hell);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:.75rem;font-weight:700;color:var(--blau);flex-shrink:0;">FD</div>
					<div><strong style="font-size:.88rem;display:block;">Florian Diehl</strong><span style="font-size:.78rem;color:var(--grau-mittel);">Gemeindeleitung · <?php efga_phone_text( '06478 / 277 200' ); ?></span></div>
				</div>
				<div style="display:flex;gap:10px;align-items:center;">
					<div style="width:38px;height:38px;background:var(--blau-sehr-hell);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:.75rem;font-weight:700;color:var(--blau);flex-shrink:0;">AG</div>
					<div><strong style="font-size:.88rem;display:block;">Andreas Genz</strong><span style="font-size:.78rem;color:var(--grau-mittel);">Gemeindeleitung · <?php efga_phone_text( '06478 / 277 99 11' ); ?></span></div>
				</div>
			</div>
		</div>
	</div>
	<div class="kontakt-karte">
		<h3>Nachricht senden</h3>
		<?php
		// Hinweis: Für echten Versand ein Formular-Plugin (z. B. Contact Form 7) einbinden
		// und den folgenden Block durch den Plugin-Shortcode ersetzen.
		?>
		<form class="kontakt-form" onsubmit="return false;">
			<label>Name</label>
			<input type="text" placeholder="Dein Name" />
			<label>E-Mail</label>
			<input type="email" placeholder="deine@email.de" />
			<label>Betreff</label>
			<select>
				<option>Allgemeine Anfrage</option>
				<option>Besuch &amp; Anfahrt</option>
				<option>Gruppen &amp; Kreise</option>
				<option>Veranstaltungen</option>
				<option>Mitgliedschaft</option>
			</select>
			<label>Nachricht</label>
			<textarea placeholder="Deine Nachricht …"></textarea>
			<button type="submit" class="btn-blau">Nachricht senden →</button>
		</form>
	</div>
</div>
