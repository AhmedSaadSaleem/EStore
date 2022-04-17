<script>
    (function(){
    var userNameField = document.querySelector('input[name=Username]');
    
    if(null !== userNameField){
        userNameField.addEventListener('blur', function(){
            var req = new XMLHttpRequest();
            req.open('POST', 'http://phpdev.com/users/checkuserexistsajax');
            req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            req.onreadystatechange = function(){
                var iElem = document.createElement("p");
                iElem.className = 'aj-error';

            }
            req.send("Username=" + this.value);

        }, false);
    }

})();
</script>
</body>
</html>