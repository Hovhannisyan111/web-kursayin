</main>
<footer class="bg-dark text-white mt-5">
    <div class="container py-4">
        <div class="row">
            <div class="col-md-6">
                <h5>Luxury Stays</h5>
                <p class="mb-0">Experience world-class hospitality</p>
            </div>
            <div class="col-md-6 text-md-end">
                <p class="mb-0">&copy; <?= date('Y') ?> Luxury Stays. All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Date validation
    const initDatePickers = () => {
        document.querySelectorAll('input[type="date"]').forEach(input => {
            if(input.name === 'check_in') {
                input.addEventListener('change', function() {
                    document.querySelector('input[name="check_out"]').min = this.value;
                });
            }
        });
    };
    initDatePickers();
    
    // Form validation
    document.querySelectorAll('.needs-validation').forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!form.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
            }
            form.classList.add('was-validated');
        });
    });
});

function confirmCancel(cn) {
    if(confirm('Are you sure you want to cancel this booking?')) {
        window.location.href = `cancel_booking.php?cn=${cn}`;
    }
}
</script>
</body>
</html>
