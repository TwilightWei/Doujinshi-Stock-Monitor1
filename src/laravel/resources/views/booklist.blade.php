<html>
    <body>
        <div class="column">
            <h2>Add a new book.</h2>
            <form action="/addbook" method="post">
                @csrf
                @method('PUT')
                Shop Name: <select name="shop_name">
　                  <option value="melonbooks">Melonbooks</option>
                </select><br>
                Product ID: <input type="text" name="product_id"><br>
                <button type="submit">Add</button>
            </form>
            <h2>Delete a book.</h2>
            <form action="/deletebook" method="post">
                @csrf
                @method('DELETE')
                Shop Name: <select name="shop_name">
　                  <option value="melonbooks">Melonbooks</option>
                </select><br>
                Product ID: <input type="text" name="product_id"><br>
                <button type="submit">Delete</button>
            </form>

        </div>
        <div class="column">
            <h2>Here is your book list.</h2>
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
        </div>
    </body>
</html>