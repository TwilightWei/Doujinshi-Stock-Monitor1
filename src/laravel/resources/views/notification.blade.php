<table>
    <tr>
        <th><h3>Shop Name</h3></th>
        <th><h3>Product ID</h3></th>
        <th><h3>Book Name</h3></th>
        <th><h3>Online Stock Status</h3></th>
        <th><h3>Shop Link</h3></th>
    </tr>
    @foreach ($booklist as $book)
    <tr>
        <th><?php echo $book->shop_name; ?></th>
        <th><?php echo $book->product_id; ?></th>
        <th><?php echo $book->book_name; ?></th>
        <th><?php echo $book->online_stock_status; ?></th>
        <th><a href="<?php echo $book->shop_page_url;?>"> Shop Link </a></th>
    </tr>
    @endforeach
</table>