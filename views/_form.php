<div>
    <form action="" method="post">
        <label for="url">URL страницы:</label>
        <input name="url" size="100" id="url" type="text" value="<?=($_POST['url'] ?? '')?>">

        <button type="submit" name="as_table">Просмотр</button>
        <button type="submit" formtarget="_blank" name="as_json">В JSON</button>
    </form>
</div>