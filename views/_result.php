<style>
    table {border-collapse: collapse}
    td, th {border: 1px solid black}
    img {width: 50px}
</style>
<div>
    <table>
        <tr>
            <th>Название</th>
            <th>Цена</th>
            <th>URL картинки</th>
            <th>Описание</th>
        </tr>
        <?php if(!empty($foods)) { ?>
            <?php foreach ($foods as $item) { ?>
                <tr>
                    <td><?=$item->title?></td>
                    <td><?=$item->price?></td>
                    <td><img src="<?=$config->getVar('TARGET_SITE').$item->pic?>"></td>
                    <td><?=$item->description?></td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <td colspan="4">
                Данных не найдено
            </td>
        <?php } ?>
    </table>
</div>