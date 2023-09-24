<div class="modal fade" id="bookingInstructionsModal" tabindex="-1" aria-labelledby="bookingInstructionsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bookingInstructionsModalLabel">How to Book a Room</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Add your booking instructions here -->
                <p>This is how you can book a room:</p>
                <ul>
                    <li>Step 1: ...</li>
                    <li>Step 2: ...</li>
                    <!-- Add more steps as needed -->
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    // JavaScript to show the modal when the page loads
    $(document).ready(function () {
        @if(Session::get('showBookingModal'))
            $('#bookingInstructionsModal').modal('show');
        @endif
    });
</script>
