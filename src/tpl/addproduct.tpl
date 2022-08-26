<!-- TOP NAV -->
<nav>
  <ul class="nav__list">
    <li class="nav__item page_name">Product Add</li>
    <div class="buttons">
      <li class="nav__item nav__button">Save</li>
      <a href="./" class="link"><li class="nav__item nav__button" id="delete-product-btn">Cancel</li></a>
    </div>
  </ul>
  <hr class="full-width">
</nav>
<!-- TOP NAV -->
<div class="product_add">
  <form method="post" id="product_form">
    <div class="form__products">
      <div class="form__input__text">
        <span>SKU</span>
        <span>Name</span>
        <span>Price ($)</span>
      </div>
      <div class="form__input__inputs">
        <div>
          <input type="text" name="sku" id="sku" placeholder="" required>
        </div>
        <div >
          <input type="text" name="name" id="name" placeholder="" required>
        </div>
        <div>
          <input type="text" name="price" id="price" pattern="[0-9]*" placeholder="" required>
        </div>
      </div>
    </div>
    <div class="form__input">
      <span>Type Switcher</span>
      <select name="switcher" id="productType" required>
        <option selected disabled>Type switcher</option>
        <option value="dvd">DVD</option>
        <option value="book">Book</option>
        <option value="furniture">Furniture</option>
      </select>
    </div>
    <!-- OTHER -->
    <!-- DVD -->
    <div class="form__other disabl" id="DVD">
      <div class="form__input">
        <span>Size (MB)</span>
        <input type="text" name="size" id="size" pattern="[0-9]*" placeholder="" aria-describedby="Please provide size" required>
      </div>
      <span class="description">"Product Description"</span>
    </div>
    <!-- DVD -->
    <!-- FURNITURE -->
    <div class="form__other disabl" id="Furniture">
      <div class="form__input">
        <span>Height (CM)</span>
        <input type="text" name="height" id="height" pattern="[0-9]*" placeholder="" aria-describedby="Please, provide height" required>
      </div>
      <div class="form__input">
        <span>Width (CM)</span>
        <input type="text" name="width" id="width" pattern="[0-9]*" placeholder="" aria-describedby="Please, provide width" required>
      </div>
      <div class="form__input">
        <span>Length (CM)</span>
        <input type="text" name="length" id="length" pattern="[0-9]*" placeholder="" aria-describedby="Please, provide length" required>
      </div>
      <span class="description">"Product Description"</span>
    </div>
    <!-- FURNITURE -->
    <!-- BOOK -->
    <div class="form__other disabl" id="Book">
      <div class="form__input">
        <span>Weight (KG)</span>
        <input type="text" name="weight" id="weight" pattern="[0-9]*" placeholder="" aria-describedby="Please provide weight" required>
      </div>
      <span class="description">"Product Description"</span>
    </div>
    <!-- BOOK -->
    <!-- OTHER -->
  </form>
</div>