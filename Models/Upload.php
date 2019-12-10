
<?php

// Upload d'un fichier

require('Connexion.php');

$error = "";
$success = "";
$emailtoError = "";
$emailError = "";
$msg = "";
$messageError = "";

// Envoi du fichier

if (isset($_POST['submit'])) {


  $subject = "Email de confirmation d'envoi";
  $message = "";
  $messageto = "";
  $msg = $_POST['message'];
  $isSuccess = true;
  $emailText = "";

  $passage_ligne = "\n";


  if (empty($_POST['emailto'])) {
    $emailtoError = "Merci de renseigner un e-mail";
    $isSuccess = false;
  }

  if (empty($_POST['email'])) {
    $emailError = "Merci de renseigner un e-mail";
    $isSuccess = false;
  }

  if (empty($_POST['message'])) {
    $messageError = "Merci de renseigner un message";
    $isSuccess = false;
  }

  if (!empty($_FILES['file']['name'][0]) && !empty($_POST['email']) && !empty($_POST['emailto']) && !empty($_POST['message'])) {

    $zip = new ZipArchive();
    $zip_name = getcwd() . "/assets/files/upload_" . time() . ".zip";

  if (empty($_POST['email'])) {
    $emailError = "Merci de renseigner un e-mail";
    $isSuccess = false;
  }

  if (empty($msg)) {
    $messageError = "Merci de renseigner un message";
    $isSuccess = false;
  }

  if (!empty($_FILES['file']['name'][0]) && !empty($_POST['email']) && !empty($_POST['emailto']) && !empty($_POST['message'])) {

    $zip = new ZipArchive();
    $zip_name = getcwd() . "/assets/files/upload_" . time() . ".zip";


    // Créer un fichier ZIP
    if ($zip->open($zip_name, ZipArchive::CREATE) !== TRUE) {
      $error .= "La compression n'a pas fonctionné.<br>";
    }

    $imageCount = count($_FILES['file']['name']);
    for ($i = 0; $i < $imageCount; $i++) {

      $ext = pathinfo($_FILES['file']['name'][$i], PATHINFO_EXTENSION);

      if ($_FILES['file']['tmp_name'][$i] == '') {
        continue;
      }
      $images = $_FILES['file']['name'];
      global $bdd;
      $statement = $bdd->prepare('INSERT INTO images (name) VALUES (?)');
      $statement->execute(array($images[$i]));
      // $newname = date('YmdHis', time()) . mt_rand() . '.' . $ext;

      // Ajoute un fichier dans un dossier ZIP
      $zip->addFromString($_FILES['file']['name'][$i], file_get_contents($_FILES['file']['tmp_name'][$i]));

      // Déplace le fichier dans le chemin défini
      // move_uploaded_file($_FILES['file']['tmp_name'][$i], './assets/files/' . $newname);
    }
    $zip->close();

    // Récupération du poids du dossier zip
    $size = filesize($zip_name);
    $size = $size / 1024;

    // Création du lien de téléchargement
    $success = basename($zip_name);
    global $bdd;
    $statement = $bdd->prepare('INSERT INTO files (url, poids, message) VALUES (?, ?, ?)');
    $statement->execute(array($success, $size, $msg));

    // Récupération de l'ID du fichier zip
    global $bdd;
    $stm = $bdd->prepare('SELECT MAX(id) FROM files');
    $stm->execute();
    $zip = $stm->fetch()['MAX(id)'];

    // Récupération des ID des derniers fichiers
    global $bdd;
    $stm = $bdd->prepare('SELECT id FROM images ORDER BY id DESC LIMIT ' . count($_FILES['file']['name']));
    $stm->execute();
    $img = $stm->fetchAll();

    // Insertion dans la table relation
    foreach ($img as $value) {
      global $bdd;
      $statement = $bdd->prepare('INSERT INTO relation (id_file, id_img) VALUES (?, ?)');
      $statement->execute(array($zip, $value['id']));
    }

  } else {
    $isSuccess = false;
    $error = '<strong>Erreur ! </strong> Merci de choisir un fichier.';
  }

  //=====Déclaration des messages au format texte et au format HTML.
  $message_html1 = '<!doctype html><html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office"><head><title></title><!--[if !mso]><!-- --><meta http-equiv="X-UA-Compatible" content="IE=edge"><!--<![endif]--><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><style type="text/css">#outlook a { padding:0; }
          body { margin:0;padding:0;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%; }
          table, td { border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt; }
          img { border:0;height:auto;line-height:100%; outline:none;text-decoration:none;-ms-interpolation-mode:bicubic; }
          p { display:block;margin:13px 0; }</style><!--[if mso]>
        <xml>
        <o:OfficeDocumentSettings>
          <o:AllowPNG/>
          <o:PixelsPerInch>96</o:PixelsPerInch>
        </o:OfficeDocumentSettings>
        </xml>
        <![endif]--><!--[if lte mso 11]>
        <style type="text/css">
          .mj-outlook-group-fix { width:100% !important; }
        </style>
        <![endif]--><style type="text/css">@media only screen and (min-width:480px) {
        .mj-column-per-100 { width:100% !important; max-width: 100%; }
      }</style><style type="text/css">@media only screen and (max-width:480px) {
      table.mj-full-width-mobile { width: 100% !important; }
      td.mj-full-width-mobile { width: auto !important; }
    }</style></head><body><div><!--[if mso | IE]><table align="center" border="0" cellpadding="0" cellspacing="0" class="" style="width:600px;" width="600" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]--><div style="margin:0px auto;max-width:600px;"><table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;"><tbody><tr><td style="direction:ltr;font-size:0px;padding:20px 0;text-align:center;"><!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" style="vertical-align:top;width:600px;" ><![endif]--><div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%"><tr><td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;"><tbody><tr><td style="width:200px;"><img height="auto" src="https://upload.johnnylemesle.fr/assets/img/logo/z-files.png" style="border:0;display:block;outline:none;text-decoration:none;height:auto;width:100%;font-size:13px;" width="200"></td></tr></tbody></table></td></tr><tr><td align="center" style="font-size:0px;padding:7px;word-break:break-word;"><div style="font-family:Arial;font-size:13px;line-height:1;text-align:center;color:#000000;">Z-Files - Le Transfert de fichier numéro 1.</div></td></tr><tr><td align="left" style="font-size:0px;padding:7px;word-break:break-word;"><div style="font-family:Arial;font-size:13px;line-height:1;text-align:left;color:#000000;">Bonjour,</div></td></tr><tr><td align="left" style="font-size:0px;padding:7px;word-break:break-word;"><div style="font-family:Arial;font-size:13px;line-height:1;text-align:left;color:#000000;">Votre lien à télécharger est le suivant :</div></td></tr><tr><td style="font-size:0px;word-break:break-word;"><!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td height="20" style="vertical-align:top;height:20px;"><![endif]--><div style="height:20px;">&nbsp;</div><!--[if mso | IE]></td></tr></table><![endif]--></td></tr><tr><td align="center" vertical-align="middle" style="font-size:0px;padding:10px 25px;word-break:break-word;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:separate;line-height:100%;"><tr><td align="center" bgcolor="#414141" role="presentation" style="border:none;border-radius:3px;cursor:auto;mso-padding-alt:10px 25px;background:#414141;" valign="middle"><a href="https://upload.johnnylemesle.fr/index.php?page=Download&url=' . $success . '" style="display:inline-block;background:#414141;color:#ffffff;font-family:Arial;font-size:13px;font-weight:normal;line-height:120%;margin:0;text-decoration:none;text-transform:none;padding:10px 25px;mso-padding-alt:0px;border-radius:3px;" target="_blank">Télécharger le fichier ZIP</a></td></tr></table></td></tr><tr><td style="font-size:0px;word-break:break-word;"><!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td height="20" style="vertical-align:top;height:20px;"><![endif]--><div style="height:20px;">&nbsp;</div><!--[if mso | IE]></td></tr></table><![endif]--></td></tr><tr><td align="left" style="font-size:0px;padding:7px;word-break:break-word;"><div style="font-family:Arial;font-size:13px;line-height:1;text-align:left;color:#000000;">Pour tout problème du téléchargement de fichier merci de cliquer sur le bouton ci-dessous.</div></td></tr><tr><td style="font-size:0px;word-break:break-word;"><!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td height="20" style="vertical-align:top;height:20px;"><![endif]--><div style="height:20px;">&nbsp;</div><!--[if mso | IE]></td></tr></table><![endif]--></td></tr><tr><td align="center" vertical-align="middle" style="font-size:0px;padding:10px 25px;word-break:break-word;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:separate;line-height:100%;"><tr><td align="center" bgcolor="#25a5c4" role="presentation" style="border:none;border-radius:3px;cursor:auto;mso-padding-alt:10px 25px;background:#25a5c4;" valign="middle"><a href="mailto:contact@johnnylemesle.fr" style="display:inline-block;background:#25a5c4;color:#ffffff;font-family:Arial;font-size:13px;font-weight:normal;line-height:120%;margin:0;text-decoration:none;text-transform:none;padding:10px 25px;mso-padding-alt:0px;border-radius:3px;" target="_blank">Contactez-nous</a></td></tr></table></td></tr><tr><td align="left" style="font-size:0px;padding:7px;word-break:break-word;"><div style="font-family:Arial;font-size:13px;line-height:1;text-align:left;color:#000000;">© Copyright 2019 - Z-Files</div></td></tr></table></div><!--[if mso | IE]></td></tr></table><![endif]--></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table><![endif]--></div></body></html>';
  //=====Création de la boundary.
  $boundary = "-----=" . md5(rand());
  $boundary_alt = "-----=" . md5(rand());
  //=====Définition du sujet.
  $subjectto = "Fichier à télécharger";
  //=====Création du header de l'e-mail.
  $header = "From: <contact@johnnylemesle.fr>" . $passage_ligne;
  $header .= "Reply-to: <contact@johnnylemesle.fr>" . $passage_ligne;
  $header .= "MIME-Version: 1.0" . $passage_ligne;
  $header .= "Content-Type: multipart/mixed;" . $passage_ligne . " boundary=\"$boundary\"" . $passage_ligne;
  //=====Création du message.
  $messageto = $passage_ligne . "--" . $boundary . $passage_ligne;
  $messageto .= "Content-Type: multipart/alternative;" . $passage_ligne . " boundary=\"$boundary_alt\"" . $passage_ligne;
  $messageto .= $passage_ligne . "--" . $boundary_alt . $passage_ligne;
  //=====Ajout du message au format texte.
  $messageto .= "Content-Type: text/plain; charset=\"UTF-8\"" . $passage_ligne;
  $messageto .= "Content-Transfer-Encoding: 8bit" . $passage_ligne;
  $messageto .= $passage_ligne . "--" . $boundary_alt . $passage_ligne;
  //=====Ajout du message au format HTML.
  $messageto .= "Content-Type: text/html; charset=\"UTF-8\"" . $passage_ligne;
  $messageto .= "Content-Transfer-Encoding: 8bit" . $passage_ligne;
  $messageto .= $passage_ligne . $message_html1 . $passage_ligne;
  //=====On ferme la boundary alternative.
  $messageto .= $passage_ligne . "--" . $boundary_alt . "--" . $passage_ligne;
  //==========
  $messageto .= $passage_ligne . "--" . $boundary . $passage_ligne;
  //=====Envoi de l'e-mail.
  $emailto = $_POST['emailto'];

  mail($emailto, $subjectto, $messageto, $header);

  //=====Déclaration des messages au format texte et au format HTML.
  $message_html = '<!doctype html><html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office"><head><title></title><!--[if !mso]><!-- --><meta http-equiv="X-UA-Compatible" content="IE=edge"><!--<![endif]--><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><style type="text/css">#outlook a { padding:0; }
          body { margin:0;padding:0;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%; }
          table, td { border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt; }
          img { border:0;height:auto;line-height:100%; outline:none;text-decoration:none;-ms-interpolation-mode:bicubic; }
          p { display:block;margin:13px 0; }</style><!--[if mso]>
        <xml>
        <o:OfficeDocumentSettings>
          <o:AllowPNG/>
          <o:PixelsPerInch>96</o:PixelsPerInch>
        </o:OfficeDocumentSettings>
        </xml>
        <![endif]--><!--[if lte mso 11]>
        <style type="text/css">
          .mj-outlook-group-fix { width:100% !important; }
        </style>
        <![endif]--><style type="text/css">@media only screen and (min-width:480px) {
        .mj-column-per-100 { width:100% !important; max-width: 100%; }
      }</style><style type="text/css">@media only screen and (max-width:480px) {
      table.mj-full-width-mobile { width: 100% !important; }
      td.mj-full-width-mobile { width: auto !important; }
    }</style></head><body><div><!--[if mso | IE]><table align="center" border="0" cellpadding="0" cellspacing="0" class="" style="width:600px;" width="600" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]--><div style="margin:0px auto;max-width:600px;"><table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;"><tbody><tr><td style="direction:ltr;font-size:0px;padding:20px 0;text-align:center;"><!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" style="vertical-align:top;width:600px;" ><![endif]--><div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%"><tr><td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;"><tbody><tr><td style="width:200px;"><img height="auto" src="https://upload.johnnylemesle.fr/assets/img/logo/z-files.png" style="border:0;display:block;outline:none;text-decoration:none;height:auto;width:100%;font-size:13px;" width="200"></td></tr></tbody></table></td></tr><tr><td align="center" style="font-size:0px;padding:7px;word-break:break-word;"><div style="font-family:Arial;font-size:13px;line-height:1;text-align:center;color:#000000;">Z-Files - Le Transfert de fichier numéro 1.</div></td></tr><tr><td align="left" style="font-size:0px;padding:7px;word-break:break-word;"><div style="font-family:Arial;font-size:13px;line-height:1;text-align:left;color:#000000;">Bonjour,</div></td></tr><tr><td align="left" style="font-size:0px;padding:7px;word-break:break-word;"><div style="font-family:Arial;font-size:13px;line-height:1;text-align:left;color:#000000;">Nous vous confirmons l\'envoi du mail à ' . $emailto . '</div></td></tr><tr><td style="font-size:0px;word-break:break-word;"><!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td height="20" style="vertical-align:top;height:20px;"><![endif]--><div style="height:20px;">&nbsp;</div><!--[if mso | IE]></td></tr></table><![endif]--></td></tr><tr><td align="left" style="font-size:0px;padding:7px;word-break:break-word;"><div style="font-family:Arial;font-size:13px;line-height:1;text-align:left;color:#000000;">Le lien de téléchargement et le suivant :</div></td></tr><tr><td style="font-size:0px;word-break:break-word;"><!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td height="20" style="vertical-align:top;height:20px;"><![endif]--><div style="height:20px;">&nbsp;</div><!--[if mso | IE]></td></tr></table><![endif]--></td></tr><tr><td align="center" vertical-align="middle" style="font-size:0px;padding:10px 25px;word-break:break-word;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:separate;line-height:100%;"><tr><td align="center" bgcolor="#414141" role="presentation" style="border:none;border-radius:3px;cursor:auto;mso-padding-alt:10px 25px;background:#414141;" valign="middle"><a href="https://upload.johnnylemesle.fr/index.php?page=Download&url=' . $success . '" style="display:inline-block;background:#414141;color:#ffffff;font-family:Arial;font-size:13px;font-weight:normal;line-height:120%;margin:0;text-decoration:none;text-transform:none;padding:10px 25px;mso-padding-alt:0px;border-radius:3px;" target="_blank">Télécharger le fichier ZIP</a></td></tr></table></td></tr><tr><td style="font-size:0px;word-break:break-word;"><!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td height="20" style="vertical-align:top;height:20px;"><![endif]--><div style="height:20px;">&nbsp;</div><!--[if mso | IE]></td></tr></table><![endif]--></td></tr><tr><td align="left" style="font-size:0px;padding:7px;word-break:break-word;"><div style="font-family:Arial;font-size:13px;line-height:1;text-align:left;color:#000000;">Pour tout problème du téléchargement de fichier merci de cliquer sur le bouton ci-dessous.</div></td></tr><tr><td style="font-size:0px;word-break:break-word;"><!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td height="20" style="vertical-align:top;height:20px;"><![endif]--><div style="height:20px;">&nbsp;</div><!--[if mso | IE]></td></tr></table><![endif]--></td></tr><tr><td align="center" vertical-align="middle" style="font-size:0px;padding:10px 25px;word-break:break-word;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:separate;line-height:100%;"><tr><td align="center" bgcolor="#25a5c4" role="presentation" style="border:none;border-radius:3px;cursor:auto;mso-padding-alt:10px 25px;background:#25a5c4;" valign="middle"><a href="mailto:contact@johnnylemesle.fr" style="display:inline-block;background:#25a5c4;color:#ffffff;font-family:Arial;font-size:13px;font-weight:normal;line-height:120%;margin:0;text-decoration:none;text-transform:none;padding:10px 25px;mso-padding-alt:0px;border-radius:3px;" target="_blank">Contactez-nous</a></td></tr></table></td></tr><tr><td align="left" style="font-size:0px;padding:7px;word-break:break-word;"><div style="font-family:Arial;font-size:13px;line-height:1;text-align:left;color:#000000;">© Copyright 2019 - Z-Files</div></td></tr></table></div><!--[if mso | IE]></td></tr></table><![endif]--></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table><![endif]--></div></body></html>';
  //=====Création de la boundary.
  $boundary = "-----=" . md5(rand());
  $boundary_alt = "-----=" . md5(rand());
  //=====Définition du sujet.
  $subjectto = "Fichier à télécharger";
  //=====Création du header de l'e-mail.
  $headers = "From: <contact@johnnylemesle.fr>" . $passage_ligne;
  $headers .= "Reply-to: <contact@johnnylemesle.fr>" . $passage_ligne;
  $headers .= "MIME-Version: 1.0" . $passage_ligne;
  $headers .= "Content-Type: multipart/mixed;" . $passage_ligne . " boundary=\"$boundary\"" . $passage_ligne;
  //=====Création du message.
  $message = $passage_ligne . "--" . $boundary . $passage_ligne;
  $message .= "Content-Type: multipart/alternative;" . $passage_ligne . " boundary=\"$boundary_alt\"" . $passage_ligne;
  $message .= $passage_ligne . "--" . $boundary_alt . $passage_ligne;
  //=====Ajout du message au format texte.
  $message .= "Content-Type: text/plain; charset=\"UTF-8\"" . $passage_ligne;
  $message .= "Content-Transfer-Encoding: 8bit" . $passage_ligne;
  $message .= $passage_ligne . "--" . $boundary_alt . $passage_ligne;
  //=====Ajout du message au format HTML.
  $message .= "Content-Type: text/html; charset=\"UTF-8\"" . $passage_ligne;
  $message .= "Content-Transfer-Encoding: 8bit" . $passage_ligne;
  $message .= $passage_ligne . $message_html . $passage_ligne;
  //=====On ferme la boundary alternative.
  $message .= $passage_ligne . "--" . $boundary_alt . "--" . $passage_ligne;
  //==========
  $message .= $passage_ligne . "--" . $boundary . $passage_ligne;
  //=====Envoi de l'e-mail.
  $email = $_POST['email'];


  mail($email, $subject, $message, $headers);
}
