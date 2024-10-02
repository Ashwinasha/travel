@extends('layouts.app')

@section('main-content')
<section class="contact-section text-center">
    <div class="container">
        <h2 class="contact-heading">Get In Touch</h2>
        <div class="row mt-5">
    <!-- Contact Form -->
    <div class="col-md-6">
        <div class="contact-form">
            <form method="POST" action="">
                @csrf
                <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                <input type="text" name="phone" class="form-control" placeholder="Phone Number">
                <input type="text" name="subject" class="form-control" placeholder="Subject">
                <textarea name="message" class="form-control" rows="4" placeholder="Your Message"></textarea>
                <div class="custom-checkbox">
                    <input type="checkbox" class="form-check-input" id="notRobot">
                    <label class="form-check-label ms-3" for="notRobot">I'm not a robot</label>
                </div>
                <button type="submit" class="btn btn-danger send-btn mt-3">Send Message</button>
            </form>
        </div>
    </div>
    <!-- Contact Info -->
    <div class="col-md-6 mt-5 align-items-center"> <!-- Added flex classes for vertical centering -->
        <div>
            <div class="contact-info text-start mt-3">
                <p><i class="bi bi-telephone-fill me-3"></i> +94777538775</p>
                <p><i class="bi bi-envelope-fill me-3"></i> Info@Travel.Com</p>
                <p><i class="bi bi-geo-alt-fill me-3"></i> No 032, Main street, Colombo, Sri Lanka.</p>
            </div>
            <div class="follow-us text-center">
                <h5 style="color:#1a237e;" class="mb-2">Follow Us</h5>
                <div class="d-flex align-items-center justify-content-center mt-3">
                    <a href="#"><i class="bi bi-facebook me-3"></i></a>
                    <a href="#"><i class="bi bi-instagram me-3"></i></a>
                    <a href="#"><i class="bi bi-whatsapp"></i></a>
                </div>
            </div>


        </div>
    </div>
</div>

        <!-- Map Section -->
        <div class="map-section mt-5">
            <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3979.5212832196825!2d79.86124381475483!3d6.927078994987224!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae2592d9f4a8ffb%3A0x7213d1370c3b6937!2sColombo!5e0!3m2!1sen!2slk!4v1604905454033!5m2!1sen!2slk"
            width="100%" height="400" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        </div>
    </div>
</section>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">
@endsection
@section('scripts')
<script src="{{ asset('js/travel.js') }}"></script>
@endsection

