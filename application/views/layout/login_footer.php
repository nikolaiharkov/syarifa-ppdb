
    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo base_url('vendor/jquery/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>

<!-- Core plugin JavaScript-->
<script src="<?php echo base_url('vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>

<!-- Custom scripts for all pages-->
<script src="<?php echo base_url('js/sb-admin-2.min.js'); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Letakkan script ini di dalam bagian <body> halaman Anda -->
<script>
    <?php if ($this->session->flashdata('success_message')): ?>
        alert('<?php echo $this->session->flashdata('success_message'); ?>');
    <?php elseif ($this->session->flashdata('error_message')): ?>
        alert('<?php echo $this->session->flashdata('error_message'); ?>');
    <?php endif; ?>
</script>


</body>

</html>