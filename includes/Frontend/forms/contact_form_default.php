<div>
  <div class="contact-form-wrapper d-flex justify-content-center">
    <form action="" class="contact-form" method="POST">
      <h5 class="title"><?php echo esc_attr( $heading ); ?></h5>
      <p class="description"> <?php echo esc_attr( $subheading ); ?> </p>
      <div>
        <input type="text" name="pxls_cf8_form_name" class="form-control rounded border-white mb-3 form-input" id="name" placeholder="Name" required>
      </div>
      <div>
        <input type="email" name="pxls_cf8_form_email" class="form-control rounded border-white mb-3 form-input" placeholder="Email" required>
      </div>
      <div>
        <textarea id="message" name="pxls_cf8_form_message" class="form-control rounded border-white mb-3 form-text-area" rows="5" cols="30" placeholder="Message" required></textarea>
      </div>
      <div class="submit-button-wrapper">
        <input type="submit" value="Send" name="pxls_cf8_form_submit">
      </div>
    </form>
  </div>
</div>
