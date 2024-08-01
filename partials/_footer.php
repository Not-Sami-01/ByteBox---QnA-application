<?php
    echo '<footer class="container-fluid text-center py-1 mt-2 text-light bg-dark ">
        <h5 class="mt-1" >Copyright &copy; 2024 | All rights reserved </h5>
    </footer>
    </body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous" ></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script>
    $(function(){
        setTimeout(() => {
            $(\'.alert\').alert(\'close\');
        }, 1000);
        $(\'.showPassword\').on(\'change\',(event)=>{
    if (event.target.checked) {
        $(\'.password\').type = \'text\';
    } else {
        $(\'.password\').type = \'password\';
    }
})
    });
    </script>
</html>';
