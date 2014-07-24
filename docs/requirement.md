Training Project

Overview

The trainee learns basic concepts, patterns and practices of building an ecommerce website.
Requirements
You must build an online store to sell mobile phones. The store has 2 main parts: store front-end and administration, which can be accessed as:
•	http://mobile.loc
•	http://mobile.loc/admin or http://admin.mobile.loc
Store Front-End
	•	Multi category levels: relationship and sorting order can be changed via admin. Example:
		o	Featured phones
				Sales
		o	Smart phones
				Main stream
				•	Android
				•	iOS
				•	Others
				Luxury
				Sales
		o	Accessories

	•	A product can be associated with multi-categories <tbl_cateproduct>
	•	A global page header shows all categories as a horizontal mega menu. Showing number of products within each category in a (bracket)(count in tbl_product where cate_id = $id)
	•	Showing a welcome lightbox for a first-time visitor (<cookie>)
	•	A homepage shows a banner slider of featured products. Admin can select any products with configurable sort order for this slider. 
	•	Clicking a menu item opens a category listing page. (<tbl_product)
	•	Category listing page shows all products in that category with basic infos: name, link, main image, listing price, sale price
		o	Filter by: brand, price range slider
		o	Sort by: name, price, date ascending and descending
		o	Pagination: showing current page, N products per page. N is configurable in admin. (làm sao để lưu thông tin của N)
	•	Clicking a product on listing page opens a product detail page. It shows all basic infos and additional infos: alternative product images (up to 10), description, brand, origin country, reviews, rating.
	•	Customer can post their star rating and review to each products *<tbl_comment>
	•	Customer can add product to shopping cart from category listing page and product detail page. (session)
	•	There is a small cart icon on the global page header. Hovering on that icon will show a popup of listing of cart items: name, price and total price(css, jquery)
	•	Shopping cart: can edit quantity, remove item or clear cart
	•	Checkout (thanh toán)


Administration
	•	Login with username and password.
	•	Manage users: create/edit/delete
	•	Create/update/delete/move any category
	•	Create/update/delete products, assign product to category
	•	Reports:
		o	Best-selling products within a time period (select by two date-pickers)
		o	Best-selling categories within a time period (select by two date-pickers)


Technical Requirements
	•	PHP 5.3 – MySQL 5
	•	Choose one of these platforms:
		o	CodeIgniter 2
	•	Strictly follow the coding standards of the selected platform
		o	NOTE: No PHP errors, warnings, notices with E_ALL mode and display_errors = On
	•	Store frontend code must use raw SQL queries. Admin backend code must use active record/ORM
	•	JavaScript must be implemented in independent JS files, except necessary dynamic generated codes
	•	Security:
		o	No SQL injection bug
		o	No XSS bug
	•	HTML code must pass W3C validator (no error)
