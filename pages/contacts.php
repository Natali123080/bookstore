<?php
// страница контакти

if (isset($_POST['submit'])) {
    $errors = [];
    foreach ($_POST as $key => $value) {
        if ($key != 'submit' && empty($value)) {
            $errors[] = "Fill in $key field!";
        }
    }

    if (count($errors) == 0) {
        echo '
            <div class="alert alert-success" role="alert">
                Hello, ' . $_POST['name'] . '! Your message has been sent to ' . $_POST['email'] . '!
            </div>
        ';
    } else {
        echo '
            <div class="alert alert-danger" role="alert">
                ' . implode('<br>', $errors) . '
            </div>
        ';
    }

}

?>
<section id="contact-faq" class="container mt-5">
    <h2 class="text-center mb-4">Contact Us</h2>
    <div class="row">
        <div class="col-md-6">
            <h4>Get in Touch</h4>
            <form class="contact-form" method="post">
                <input type="text" name="name" class="form-control mb-3" placeholder="Your Name" required>
                <input type="email" name="email" class="form-control mb-3" placeholder="Your Email" required>
                <textarea class="form-control mb-3" rows="4" placeholder="Your Message" name="message" required></textarea>
                <button type="submit" name="submit" class="btn btn-primary">Send Message</button>
            </form>
        </div>
        <div class="col-md-6 text-end">
            <h4>Contact Information</h4>
            <p><strong>Email:</strong> support@velaris.com</p>
            <p><strong>Phone:</strong> +1 (123) 456-7890</p>
            <p><strong>Address:</strong> 123 Book Street, Reading City, 98765</p>
            <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d241.291574136588!2d27.918063877678772!3d43.22087362060075!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1svelaris!5e0!3m2!1sbg!2sbg!4v1734374361211!5m2!1sbg!2sbg" width="400" height="170" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>

    <h2 class="text-center mt-5 mb-4">Frequently Asked Questions</h2>
    <div class="accordion" id="faqAccordion">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                What is your return policy?
            </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
            <div class="accordion-body">
                We accept returns within 30 days of purchase, provided the book is in its original condition.
            </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Do you offer international shipping?
            </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
            <div class="accordion-body">
                Yes, we ship to most countries worldwide. Shipping fees and delivery times vary by location.
            </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                How can I track my order?
            </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
            <div class="accordion-body">
                Once your order is shipped, you will receive a tracking number via email.
            </div>
            </div>
        </div>
    </div>
</section>