<!-- ======= Footer ======= -->
<footer id="footer">
    <div class="container">
        <h3>E-ZESCO HOME</h3>
        <p>Your central platform for accessing a wide range of seamlessly integrated and developed systems, simplifying your Zesco online experience .</p>

        <div class="social-links">
            <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
            <a href="https://www.facebook.com/ZESCOCORP" class="facebook"><i class="bx bxl-facebook"></i></a>
            <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
            <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
            <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a> <br><br>



<!-- Button in the website footer -->
<button type="button" class="btn btn-warning"   data-bs-toggle="modal" data-bs-target="#suggestionModal"
title=" Suggest areas of system improvement to enhance and make Zesco system's better "
>
  Product Suggestion Box
</button>

<!-- Modal -->
<div class="modal fade" id="suggestionModal" tabindex="-1" aria-labelledby="suggestionModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title" id="suggestionModalLabel">Product Suggestion Box</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body">
        <!-- Your existing content here -->
        <!-- ... -->
        <div  class="row text-center">
        <div >

<h6  style="color:black"> Importance Of Your Feedback</h3>
<h7 class="mb-4 mt-1 text-sm"  style="color:black">
 We invite you to join our group of change-makers and contribute your thoughts to help shape

    the company.We believe that every idea has the potential to be a game-changer. By utilizing our
    online
    suggestion box, you gain a platform that amplifies your voice and ensures your input reaches the
    decision-makers who can turn your suggestions into reality.
</h5>
<hr  style="color:green">
<h6 style="color:#d86100" class="text-bold">Suggest areas of system improvement to enhance and make Zesco system's better </h6>
<hr  style="color:green" >

</div>
        <div>
       
       
        <form action="{{ route('ezesco-home.suggestion.save') }}" method="POST">
    @csrf

    <div class="row mt-2">
    <div class="col-md-6 col-sm-12">
    <div class="mb-3">
      <input name="subject" type="text" class="form-control" placeholder="Title Of Suggestion" required>
    </div>
    </div>
 
    <div class="col-md-6 col-sm-12">
    <div class="mb-3">
      <input name="system_name" type="text" class="form-control" placeholder="Proposed System name" required>
    </div>
    </div>
    </div>

    <div class="row">
    <div class="col-md-12 col-sm-12">
    <div class="mb-3">
      <textarea name="suggestion" class="form-control" rows="6" placeholder="Enter System Suggestion" required></textarea>
    </div>
    </div>
    </div>

    <div class="row">
    <div class="col-md-4 col-sm-12">
    <div class="mb-3">
      <input name="name" type="text" class="form-control" placeholder="Your Name" required>
    </div>
    </div>
  
    <div class="col-md-4 col-sm-12">
    <div class="mb-3">
      <input name="email" type="email" class="form-control" placeholder="Your Email" required>
    </div>
    </div>
   
    <div class="col-md-4 col-sm-12">
    <div class="mb-3">
      <input name="department" type="text" class="form-control" placeholder="Your Department" required>
    </div>
    </div>
    </div>

    <div class="modal-footer">
    <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
      <button type="submit" class="btn btn-success"  >Submit Suggestion</button>
    </div>
  </form>
</div>

        </div>
      </div>
    </div>
  </div>
</div>




        </div>
        <div class="copyright">
            &copy; Copyright <strong><span>E-ZESCO HOME</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            Designed by <a href="https://www.zesco.co.zm"  target="_blank" style="color: white">Innovation and Systems Development Division - ICT © ZESCO Limited.</a> </p>
        </div>
    </div>
</footer><!-- End Footer -->
