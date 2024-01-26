<h1 style="color:green"><?= $pagetitle ?></h1>
<form action="store/file" method="post" enctype="multipart/form-data">
    <input type="file" name="receipt[]" />
    <input type="file" name="receipt[]" />
    <button><?= $buttontitle ?></button>
</form>