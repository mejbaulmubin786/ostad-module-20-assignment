অবশ্যই, পুরো Laravel প্রজেক্ট তৈরির প্রতিটি ধাপকে ধারাবাহিকভাবে ব্যাখ্যা করা হলো। এভাবে বর্ণনা করা হলে Laravel প্রজেক্ট ডেভেলপমেন্টের পুরো প্রক্রিয়া আরও পরিষ্কার হবে।

---

### ধাপ ১: Laravel প্রজেক্ট ইনস্টল করা

প্রথমে, একটি নতুন Laravel প্রজেক্ট তৈরি করা হয়েছে। এটি করা হয় `laravel new project_name` বা `composer create-project laravel/laravel project_name` কমান্ড দিয়ে।

### ধাপ ২: ডাটাবেজ কানেকশন সেটআপ করা

`.env` ফাইলে ডাটাবেজের সাথে কানেকশন করার জন্য প্রয়োজনীয় সেটিংস করা হয়েছে, যেমন `DB_DATABASE`, `DB_USERNAME`, এবং `DB_PASSWORD`। এটি নিশ্চিত করে যে প্রজেক্ট ডাটাবেজের সাথে যোগাযোগ করতে পারবে।

### ধাপ ৩: মডেল এবং মাইগ্রেশন তৈরি করা

Laravel এ ডাটাবেজ টেবিল এবং ডেটা মডেল তৈরির জন্য প্রথমে একটি `Product` মডেল এবং তার সাথে মাইগ্রেশন ফাইল তৈরি করা হয়েছে:

```bash
php artisan make:model Product -m
```

এই কমান্ডটি `Product` মডেল এবং `create_products_table` নামক মাইগ্রেশন ফাইল তৈরি করে, যাতে টেবিলের কাঠামো নির্ধারণ করা যাবে।

### ধাপ ৪: মাইগ্রেশন ফাইলে টেবিলের কাঠামো নির্ধারণ করা

মাইগ্রেশন ফাইলে `products` টেবিলের কাঠামো নির্ধারণ করা হয়েছে, যেখানে প্রোডাক্টের `id`, `product_id`, `name`, `description`, `price`, `stock`, এবং `image` ফিল্ড যোগ করা হয়েছে।
উদাহরণস্বরূপ:

```php
$table->id();
$table->string('product_id');
$table->string('name');
$table->text('description')->nullable();
$table->decimal('price', 8, 2);
$table->integer('stock')->nullable();
$table->string('image')->nullable();
```

এরপর এই মাইগ্রেশন চালানো হয়েছে:

```bash
php artisan migrate
```

এটি `products` নামে একটি টেবিল ডাটাবেজে তৈরি করে।

### ধাপ ৫: কন্ট্রোলার তৈরি করা

`ProductController` নামে একটি কন্ট্রোলার তৈরি করা হয়েছে:

```bash
php artisan make:controller ProductController --resource
```

এই কন্ট্রোলারটি `index`, `create`, `store`, `show`, `edit`, `update`, এবং `destroy` এর মত বিভিন্ন মেথড তৈরির জন্য ব্যবহার হয়, যা CRUD অপারেশনগুলোর জন্য প্রয়োজন।

### ধাপ ৬: রাউটিং কনফিগার করা

`routes/web.php` ফাইলে `ProductController` এর জন্য রাউট যুক্ত করা হয়েছে। রিসোর্সফুল রাউট দিয়ে এটি করা যায়:

```php
Route::resource('products', ProductController::class);
```

এই রাউটগুলো বিভিন্ন URL এর জন্য মেথড কল করতে ব্যবহৃত হয়, যেমন `/products` এর জন্য `index` মেথড, `/products/create` এর জন্য `create` মেথড, ইত্যাদি।

### ধাপ ৭: কন্ট্রোলার মেথডে লজিক যুক্ত করা

`ProductController` এর প্রতিটি মেথডে প্রয়োজনীয় লজিক যুক্ত করা হয়েছে। উদাহরণস্বরূপ:

-   `index` মেথডে সকল প্রোডাক্ট প্রদর্শনের জন্য ডাটাবেজ থেকে ডেটা নিয়ে `index` ভিউতে পাঠানো হয়।
-   `create` মেথডে নতুন প্রোডাক্ট তৈরির ফর্ম দেখানো হয়।
-   `store` মেথডে নতুন প্রোডাক্ট ডাটাবেজে সংরক্ষণ করা হয়।
-   `edit` এবং `update` মেথডে প্রোডাক্ট আপডেট করা হয়।
-   `destroy` মেথডে প্রোডাক্ট ডিলিট করা হয়।

### ধাপ ৮: ব্লেড ভিউ ফাইল তৈরি করা

প্রতিটি রাউটের জন্য ব্লেড টেমপ্লেট তৈরি করা হয়েছে:

-   **index.blade.php**: সমস্ত প্রোডাক্ট তালিকা প্রদর্শন করে।
-   **create.blade.php**: নতুন প্রোডাক্ট যোগ করার ফর্ম দেখায়।
-   **edit.blade.php**: প্রোডাক্ট এডিট করার ফর্ম দেখায়।
-   **show.blade.php**: নির্দিষ্ট একটি প্রোডাক্ট দেখায়।

### ধাপ ৯: পেজিনেশন যুক্ত করা

`index` মেথডে প্রোডাক্ট তালিকায় পেজিনেশন যুক্ত করা হয়েছে:

```php
$products = Product::paginate(10);
```

এবং `index.blade.php` ফাইলে পেজিনেশন লিংক দেখানোর জন্য `{{ $products->links() }}` ব্যবহার করা হয়েছে।

### ধাপ ১০: Blade ফাইলের স্টাইলিং এবং কাস্টমাইজেশন

প্রতিটি ব্লেড ফাইলে প্রোডাক্ট ম্যানেজমেন্টের জন্য প্রয়োজনীয় HTML এবং CSS ব্যবহার করে ফর্ম এবং টেবিল তৈরি করা হয়েছে। Bootstrap ব্যবহার করা হলে সেসব CSS ক্লাস যোগ করা হয়েছে, যেমন: `table`, `btn`, `form-control`, ইত্যাদি।

### ধাপ ১১: ডিবাগিং এবং ফাইনাল টাচ

প্রয়োজনে ভুলগুলো ঠিক করা হয়েছে, যেমন পেজিনেশনের চিহ্ন ঠিক করা, রাউটিং সমস্যা সমাধান করা, Blade ফাইলে লজিক সঠিকভাবে বসানো ইত্যাদি।

---

এইভাবেই Laravel এর মাধ্যমে একটি প্রোডাক্ট ম্যানেজমেন্ট সিস্টেম ধাপে ধাপে তৈরি করা হয়েছে।

### মডেল ফাইলের কাজ এবং এর ভূমিকা

Laravel এ **মডেল** হলো সেই ফাইল, যা ডাটাবেজ টেবিলের সাথে কাজ করে এবং অ্যাপ্লিকেশনের লজিক্যাল অংশে ডেটার প্রতিনিধিত্ব করে। এটি `app/Models` ফোল্ডারে থাকে। মডেল ব্যবহার করে ডাটাবেজ থেকে ডেটা রিড, রাইট, আপডেট এবং ডিলিট করা যায়। উদাহরণস্বরূপ, `Product` মডেলটি `products` টেবিলের সাথে যুক্ত থাকে, যেখানে টেবিলের বিভিন্ন রেকর্ড বা রো গুলোকে "অবজেক্ট" হিসেবে ব্যবহার করা যায়।

Laravel এ মডেল তৈরি করা হয় মূলত তিনটি কারণে:

1. **ডাটাবেস অপারেশনকে সহজতর করা**: মডেল ব্যবহার করে সহজেই ডাটাবেজের উপর বিভিন্ন অপারেশন (CRUD) চালানো যায়, যেমন `Product::all()` দিয়ে সব প্রোডাক্ট ফেচ করা।

2. **ব্যবসায়িক লজিকের ধারণা তৈরি করা**: মডেল বিভিন্ন ব্যবসায়িক লজিক ধারণ করে, যেমন যদি প্রোডাক্টের মূল্য গণনা করতে হয় বা বিশেষ কোনো শর্তে ফিল্টার করতে হয়, তাহলে সেগুলো মডেলে সংরক্ষণ করা যায়।

3. **রিলেশনশিপ ম্যানেজ করা**: Laravel এ মডেল রিলেশনশিপ মেইনটেইন করতে সাহায্য করে, যেমন `hasMany`, `belongsTo`, `hasOne` ইত্যাদি। এই ফিচার দিয়ে ডাটাবেজের বিভিন্ন টেবিলের মধ্যে সম্পর্ক তৈরি করা যায়।

### মাইগ্রেশন ফাইলের কাজ এবং এর ভূমিকা

**মাইগ্রেশন** ফাইল হলো সেই ফাইল, যা Laravel প্রজেক্টে ডাটাবেজ টেবিলের কাঠামো (schema) তৈরি বা পরিবর্তন করতে ব্যবহৃত হয়। প্রতিটি মাইগ্রেশন ফাইলে টেবিলের জন্য প্রয়োজনীয় কলাম এবং তাদের ধরন সংজ্ঞায়িত করা হয়।

যেমন, `products` টেবিলের জন্য মাইগ্রেশন ফাইলে নিচের মত করে কলাম তৈরি করা হতে পারে:

```php
public function up()
{
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('product_id');
        $table->string('name');
        $table->text('description')->nullable();
        $table->decimal('price', 8, 2);
        $table->integer('stock')->nullable();
        $table->string('image')->nullable();
        $table->timestamps();
    });
}
```

Laravel এ মাইগ্রেশন ফাইলের কাজগুলো:

1. **ডাটাবেজ টেবিল তৈরি করা**: নতুন টেবিল তৈরি করা, যেমন `products` টেবিল।
2. **স্কিমা পরিবর্তন করা**: টেবিলে নতুন কলাম যোগ করা বা অপ্রয়োজনীয় কলাম বাদ দেওয়া।
3. **টেবিল ড্রপ করা বা রোলব্যাক করা**: প্রয়োজনে টেবিল মুছে ফেলা বা পূর্ববর্তী অবস্থায় ফিরিয়ে নেওয়া।

### মডেল এবং মাইগ্রেশনের সম্পর্ক

Laravel এ মডেল এবং মাইগ্রেশন একে অপরের পরিপূরক:

-   **মডেল** ডাটাবেজ টেবিলের সাথে কাজ করে এবং ডাটাবেজে থাকা ডেটার সাথে সরাসরি ইন্টারঅ্যাক্ট করে।
-   **মাইগ্রেশন** টেবিলের কাঠামো তৈরি করে। এটি নিশ্চিত করে যে, ডাটাবেজের টেবিল এবং কলামগুলো সঠিকভাবে তৈরি হয়েছে কিনা।

মডেল এবং মাইগ্রেশন একসাথে কাজ করে যাতে ডাটাবেজ অপারেশনগুলো খুব সহজ ও সংগঠিতভাবে করা যায়।

### শুধুমাত্র মডেল বা শুধুমাত্র মাইগ্রেশন দিয়ে কাজ সম্পূর্ণ করা যেত না

#### শুধুমাত্র মডেল দিয়ে কাজ করা

শুধুমাত্র মডেল দিয়ে কাজ করতে গেলে টেবিলের কাঠামো ডাটাবেজে ম্যানুয়ালি তৈরি করতে হতো। Laravel এর মাইগ্রেশন সিস্টেম ব্যবহার না করলে, টেবিল তৈরি বা পরিবর্তন করার ক্ষেত্রে ডাটাবেসে সরাসরি SQL কোড ব্যবহার করতে হবে, যা ডেভেলপমেন্ট এবং টিম ওয়ার্কের ক্ষেত্রে সময়সাপেক্ষ এবং ঝামেলাপূর্ণ।

#### শুধুমাত্র মাইগ্রেশন দিয়ে কাজ করা

শুধুমাত্র মাইগ্রেশন দিয়ে কাজ করতে গেলে ডাটাবেজের টেবিল তৈরি করা যাবে, কিন্তু ডাটাবেসের সাথে ডেটা রিড, রাইট বা আপডেট করার জন্য মডেলের প্রয়োজন। মডেল না থাকলে ডাটাবেজের রেকর্ডগুলোর সাথে Laravel এর ORM (Eloquent) ব্যবহার করে সহজে কাজ করা সম্ভব হবে না।

### উপসংহার

মডেল এবং মাইগ্রেশন একে অপরের পরিপূরক এবং Laravel প্রজেক্টে ডাটাবেস ব্যবস্থাপনার জন্য এদের দুটোকেই প্রয়োজন। মডেল ডাটাবেজের ডেটার উপর অপারেশন করতে সাহায্য করে, আর মাইগ্রেশন টেবিলের কাঠামো মেইনটেইন করতে সাহায্য করে।
Laravel এ `Route::resource('products', ProductController::class);` এই একটি লাইন দিয়ে একসাথে বিভিন্ন RESTful রাউট তৈরি করা যায়। এটিকে **Resourceful Routing** বলা হয়।

### Resourceful Routing কী?

Resourceful Routing হলো Laravel এর একটি সুবিধা, যার মাধ্যমে একটি নির্দিষ্ট রিসোর্স (যেমন, `products`) এর জন্য একবারে সবগুলো স্ট্যান্ডার্ড রাউট তৈরি করা যায়। এই স্ট্যান্ডার্ড রাউটগুলো হলঃ **index**, **create**, **store**, **show**, **edit**, **update**, এবং **destroy**।

`Route::resource` ব্যবহার করে আমরা এই রাউটগুলো অটোমেটিক তৈরি করতে পারি। প্রতিটি রাউটের জন্য প্রয়োজনীয় HTTP মেথড এবং URL প্যাটার্নও নির্ধারিত থাকে, যা RESTful অ্যাপ্লিকেশন ডিজাইন করার জন্য আদর্শ।

### Route::resource দিয়ে যে রাউটগুলো তৈরি হয়

যখন `Route::resource('products', ProductController::class);` ব্যবহার করা হয়, তখন নিচের রাউটগুলো তৈরি হয়:

| HTTP Method | URL                 | Controller Method | কাজ                                 |
| ----------- | ------------------- | ----------------- | ----------------------------------- |
| GET         | /products           | index             | সব প্রোডাক্টের তালিকা দেখায়         |
| GET         | /products/create    | create            | নতুন প্রোডাক্ট তৈরি করার ফর্ম দেখায় |
| POST        | /products           | store             | নতুন প্রোডাক্ট সংরক্ষণ করে          |
| GET         | /products/{id}      | show              | নির্দিষ্ট প্রোডাক্ট দেখায়           |
| GET         | /products/{id}/edit | edit              | প্রোডাক্ট সম্পাদনার ফর্ম দেখায়      |
| PUT/PATCH   | /products/{id}      | update            | নির্দিষ্ট প্রোডাক্ট আপডেট করে       |
| DELETE      | /products/{id}      | destroy           | নির্দিষ্ট প্রোডাক্ট মুছে ফেলে       |

### Resourceful Routing কিভাবে কাজ করে?

1. **Controller**: Resourceful Routing কাজ করার জন্য প্রথমেই একটি **Resource Controller** তৈরি করতে হবে। এই কন্ট্রোলারটি Laravel এর **artisan** কমান্ড ব্যবহার করে তৈরি করা যায়:

    ```bash
    php artisan make:controller ProductController --resource
    ```

    এই কমান্ডটি চালানোর পর, `ProductController` নামে একটি কন্ট্রোলার তৈরি হবে, যেখানে Resourceful Routing অনুযায়ী প্রয়োজনীয় সকল মেথড থাকবে (index, create, store, show, edit, update, destroy)।

2. **Route**: কন্ট্রোলার তৈরি হয়ে গেলে `Route::resource` ব্যবহার করে রাউটগুলো ডিফাইন করা হয়। উদাহরণঃ

    ```php
    Route::resource('products', ProductController::class);
    ```

    এই এক লাইনের মাধ্যমে Laravel নিজে থেকেই সমস্ত RESTful রাউট তৈরির কাজ করে নেয়।

### Resourceful Routing এর সুবিধা

-   **সংক্ষিপ্ত কোড**: এক লাইনের রাউটিং কোড দিয়ে বিভিন্ন CRUD অপারেশন পরিচালিত হয়।
-   **সাবলীল অ্যাপ্লিকেশন ডিজাইন**: RESTful ডিজাইনের মান অনুসরণ করে কোড রাইটিংয়ের সুব্যবস্থা করে।
-   **কোড মেইনটেন করা সহজ**: প্রতিটি অপারেশন আলাদা মেথডে বিভক্ত থাকে, ফলে কোড পড়া, বোঝা এবং মেইনটেন করা সহজ হয়।

### Resourceful Routing দিয়ে তৈরি রাউটগুলো কাস্টমাইজ করা

কখনো কখনো আমাদের প্রয়োজন অনুযায়ী কিছু নির্দিষ্ট মেথড বাদ দিতে হতে পারে বা শুধুমাত্র কিছু মেথড অন্তর্ভুক্ত করতে হতে পারে। উদাহরণস্বরূপ, যদি আমরা শুধুমাত্র `index`, `show`, এবং `store` মেথড রাখতে চাই, তাহলে এটি এমনভাবে করা যায়:

```php
Route::resource('products', ProductController::class)->only(['index', 'show', 'store']);
```

অথবা, যদি আমরা `destroy` মেথড বাদ দিতে চাই, তাহলে:

```php
Route::resource('products', ProductController::class)->except(['destroy']);
```

### উপসংহার

`Route::resource` Laravel এর একটি শক্তিশালী ফিচার, যা এক লাইনের কোড দিয়ে সম্পূর্ণ CRUD অপারেশন পরিচালনা করতে সাহায্য করে। এটি অ্যাপ্লিকেশনকে RESTful ভাবে ডিজাইন করতে এবং কোডকে আরও সংগঠিত ও মেইনটেইনেবল করতে সাহায্য করে।
আপনার প্রজেক্টে `image` ফিল্ডটি যুক্ত করতে, আমাদের কয়েকটি ফাইল আপডেট করতে হবে। মূলত, আমরা তিনটি ধাপে কাজটি করব:

1. **মাইগ্রেশন আপডেট করা**: `products` টেবিলে `image` ফিল্ডটি যোগ করব।
2. **মডেল আপডেট করা**: `Product` মডেলে `image` ফিল্ডটি নিশ্চিত করব।
3. **কন্ট্রোলার ও ভিউ আপডেট করা**: নতুন ফিল্ডটি গ্রহণ ও প্রদর্শনের জন্য কন্ট্রোলার এবং ভিউতে পরিবর্তন করব।

এখানে বিস্তারিতভাবে প্রতিটি ধাপ আলোচনা করা হলো।

---

### Step 1: মাইগ্রেশন ফাইলে image ফিল্ড যুক্ত করা

প্রথমে একটি নতুন মাইগ্রেশন ফাইল তৈরি করে `products` টেবিলে `image` ফিল্ডটি যোগ করব। টার্মিনালে নিচের কমান্ডটি রান করুন:

```bash
php artisan make:migration add_image_to_products_table --table=products
```

এতে `add_image_to_products_table` নামে একটি নতুন মাইগ্রেশন ফাইল তৈরি হবে, যা `products` টেবিলে `image` কলামটি যুক্ত করার জন্য ব্যবহৃত হবে।

মাইগ্রেশন ফাইলে গিয়ে নিচের কোডটি যোগ করুন:

```php
public function up()
{
    Schema::table('products', function (Blueprint $table) {
        $table->string('image')->nullable(); // image ফিল্ডটি অপশনাল হিসেবে যোগ করা
    });
}

public function down()
{
    Schema::table('products', function (Blueprint $table) {
        $table->dropColumn('image'); // image ফিল্ডটি ড্রপ করা (rollback এর জন্য)
    });
}
```

এবার মাইগ্রেশন চালিয়ে দিন:

```bash
php artisan migrate
```

এতে `products` টেবিলে `image` কলামটি যুক্ত হয়ে যাবে।

---

### Step 2: Product মডেলে image ফিল্ড যুক্ত করা

`Product` মডেলে আমরা `image` ফিল্ডটি fillable (mass assignable) হিসেবে উল্লেখ করব, যেন সহজে ফর্ম থেকে ডেটা গ্রহণ করা যায়।

`app/Models/Product.php` ফাইলটি খুলুন এবং `$fillable` অ্যারেতে `image` ফিল্ডটি যোগ করুন:

```php
protected $fillable = [
    'product_id',
    'name',
    'description',
    'price',
    'stock',
    'image', // image ফিল্ড যোগ করা
];
```

---

### Step 3: Controller এবং View আপডেট করা

#### ProductController আপডেট করা

`store` এবং `update` মেথডগুলো আপডেট করতে হবে যাতে `image` ফিল্ড থেকে ডেটা গ্রহণ ও সংরক্ষণ করতে পারে।

`app/Http/Controllers/ProductController.php` ফাইলে `store` এবং `update` মেথড আপডেট করুন।

**store মেথড:**

```php
public function store(Request $request)
{
    $request->validate([
        'product_id' => 'required|unique:products',
        'name' => 'required',
        'price' => 'required|numeric',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // image validation
    ]);

    // ইমেজ ফাইল সেভ করা
    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('products', 'public');
    }

    Product::create([
        'product_id' => $request->input('product_id'),
        'name' => $request->input('name'),
        'description' => $request->input('description'),
        'price' => $request->input('price'),
        'stock' => $request->input('stock'),
        'image' => $imagePath,
    ]);

    return redirect()->route('products.index')->with('success', 'Product created successfully.');
}
```

**update মেথড:**

```php
public function update(Request $request, Product $product)
{
    $request->validate([
        'product_id' => 'required|unique:products,product_id,' . $product->id,
        'name' => 'required',
        'price' => 'required|numeric',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // image validation
    ]);

    // ইমেজ ফাইল আপডেট করা
    if ($request->hasFile('image')) {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->image = $request->file('image')->store('products', 'public');
    }

    $product->update([
        'product_id' => $request->input('product_id'),
        'name' => $request->input('name'),
        'description' => $request->input('description'),
        'price' => $request->input('price'),
        'stock' => $request->input('stock'),
        'image' => $product->image,
    ]);

    return redirect()->route('products.index')->with('success', 'Product updated successfully.');
}
```

#### View ফাইলগুলো আপডেট করা

##### create.blade.php (নতুন প্রোডাক্ট তৈরি করার ফর্ম)

`resources/views/products/create.blade.php` এ একটি ফাইল ইনপুট যোগ করুন:

```html
<form
    action="{{ route('products.store') }}"
    method="POST"
    enctype="multipart/form-data"
>
    @csrf
    <!-- অন্যান্য ইনপুট ফিল্ড -->
    <div class="form-group">
        <label for="image">Product Image</label>
        <input type="file" class="form-control" name="image" id="image" />
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
</form>
```

##### edit.blade.php (প্রোডাক্ট সম্পাদনার ফর্ম)

`resources/views/products/edit.blade.php` এ একইভাবে `image` ইনপুট যুক্ত করুন:

```html
<form
    action="{{ route('products.update', $product->id) }}"
    method="POST"
    enctype="multipart/form-data"
>
    @csrf @method('PUT')
    <!-- অন্যান্য ইনপুট ফিল্ড -->
    <div class="form-group">
        <label for="image">Product Image</label>
        <input type="file" class="form-control" name="image" id="image" />
        @if($product->image)
        <img
            src="{{ asset('storage/' . $product->image) }}"
            alt="Product Image"
            width="100"
        />
        @endif
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
```

##### index.blade.php (প্রোডাক্ট লিস্ট দেখানোর জন্য)

`resources/views/products/index.blade.php` এ `image` কলামটি দেখানোর জন্য কোড যুক্ত করুন:

```html
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Product ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->product_id }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->price }}</td>
            <td>
                @if($product->image)
                <img
                    src="{{ asset('storage/' . $product->image) }}"
                    alt="Product Image"
                    width="50"
                />
                @endif
            </td>
            <td>
                <a href="{{ route('products.show', $product->id) }}">View</a>
                <a href="{{ route('products.edit', $product->id) }}">Edit</a>
                <form
                    action="{{ route('products.destroy', $product->id) }}"
                    method="POST"
                    style="display: inline;"
                >
                    @csrf @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
```

---

### সংক্ষেপে ধাপগুলো

1. মাইগ্রেশনে `image` কলাম যুক্ত করা।
2. মডেলে `$fillable` এর মধ্যে `image` যোগ করা।
3. `ProductController`-এ `store` ও `update` মেথডে `image` ফিল্ড প্রসেস করা।
4. `create`, `edit`, এবং `index` ভিউ ফাইলে `image` ফিল্ড যোগ করে প্রদর্শন করা।

এবার এই পরিবর্তনগুলো করার পর চেক করুন যে সবকিছু সঠিকভাবে কাজ করছে কিনা।
এই ত্রুটির মানে হলো `products` টেবিলে `image` নামক কলামটি ইতিমধ্যেই বিদ্যমান আছে। সম্ভবত আপনি আগে এই ফিল্ডটি যোগ করেছেন, কিন্তু সেই মাইগ্রেশনটি চালানোর পর থেকে তা বাতিল (rollback) করেননি। এই কারণে পুনরায় `image` ফিল্ড যোগ করার চেষ্টা করলে "Duplicate column name" ত্রুটি দেখা দিচ্ছে।

এই সমস্যাটি সমাধানের জন্য আপনি নিম্নোক্ত পদক্ষেপগুলো অনুসরণ করতে পারেন:

### সমাধান পদ্ধতি

1. **মাইগ্রেশন রিভিউ করুন**:
   প্রথমে চেক করুন যে, আপনার ডেটাবেসের `products` টেবিলে `image` কলামটি ইতিমধ্যেই আছে কিনা। যদি থাকে, তবে নতুন মাইগ্রেশনটি অপ্রয়োজনীয় হবে। তাই মাইগ্রেশনটি বাদ দিতে হবে।

2. **মাইগ্রেশন রোলব্যাক করুন**:
   আপনার বর্তমান মাইগ্রেশনগুলো রোলব্যাক করতে পারেন এবং এরপর মাইগ্রেশন আবার চালাতে পারেন।

    ```bash
    php artisan migrate:rollback
    ```

3. **মাইগ্রেশন সংশোধন করা**:
   যদি আপনি নিশ্চিত হন যে `products` টেবিলে `image` কলামটি ইতিমধ্যেই আছে, তবে নতুন তৈরি করা মাইগ্রেশন ফাইল (`add_image_to_products_table`) টি ডিলিট করুন অথবা সেই ফাইলে `image` ফিল্ড যুক্ত করার কোডটি সরিয়ে ফেলুন।

4. **মাইগ্রেশন পুনরায় চালান**:
   রোলব্যাক করার পর আবারও মাইগ্রেশন চালান, যাতে অন্য সব মাইগ্রেশন ঠিক থাকে এবং `image` কলামটি পুনরায় যুক্ত করার চেষ্টা না করে।

    ```bash
    php artisan migrate
    ```

5. **সমাধান চেক করুন**:
   এখন আপনার ডেটাবেসে গিয়ে `products` টেবিলটি চেক করুন। যদি সেখানে `image` কলামটি সঠিকভাবে থাকে, তবে আপনি সফলভাবে সমস্যাটি সমাধান করতে পেরেছেন।

---

**উল্লেখ্য:** যদি আপনি মনে করেন `image` ফিল্ডটি টেবিলে সংযোজন করা হয়নি, তবে `migrate:fresh` কমান্ড চালিয়ে ডাটাবেস রিফ্রেশ করতে পারেন। এটি সকল মাইগ্রেশন ফাইল আবার চালাবে এবং ডাটাবেসের সব টেবিল রিসেট করবে। তবে এই পদ্ধতিটি সাবধানতার সাথে ব্যবহার করুন, কারণ এটি আপনার ডাটাবেসের সকল তথ্য মুছে ফেলে সব টেবিল পুনঃনির্মাণ করবে।

```bash
php artisan migrate:fresh
```

আপনাকে পূর্ণ Laravel প্রজেক্ট বা সমস্ত ফাইল একসাথে সরবরাহ করা সম্ভব নয় কারণ এটি একটি কোড শেয়ারিং প্ল্যাটফর্ম নয় এবং প্রজেক্ট ফাইলগুলির সাইজও বড় হতে পারে। তবে আমি আপনাকে প্রতিটি প্রয়োজনীয় ফাইলের নির্দেশিকা এবং পরিবর্তন সমূহের তালিকা দিয়ে সাহায্য করতে পারি। নিচে প্রজেক্টের মূল অংশগুলোর ফাইলের তালিকা এবং প্রতিটি ফাইলের প্রয়োজনীয় অংশ উল্লেখ করেছি।

### Laravel প্রজেক্টে সংশোধিত এবং প্রয়োজনীয় ফাইলসমূহ

#### 1. **Migration File** (Add `image` Column to `products` Table)

-   `database/migrations/YYYY_MM_DD_add_image_to_products_table.php`
-   এখানে `products` টেবিলে `image` কলাম যোগ করতে মাইগ্রেশন তৈরি করা হয়েছে।

```php
public function up()
{
    Schema::table('products', function (Blueprint $table) {
        if (!Schema::hasColumn('products', 'image')) {
            $table->string('image')->nullable()->after('stock');
        }
    });
}

public function down()
{
    Schema::table('products', function (Blueprint $table) {
        $table->dropColumn('image');
    });
}
```

#### 2. **Model** (Product Model)

-   `app/Models/Product.php`
-   এই ফাইলে `fillable` অ্যাট্রিবিউটের মধ্যে `image` ফিল্ড যুক্ত করা হয়েছে।

```php
protected $fillable = [
    'product_id', 'name', 'description', 'price', 'stock', 'image'
];
```

#### 3. **Controller** (ProductController)

-   `app/Http/Controllers/ProductController.php`
-   এখানে ইমেজ আপলোডের জন্য স্টোর এবং আপডেট মেথডে পরিবর্তন করা হয়েছে।

```php
public function store(Request $request)
{
    $validatedData = $request->validate([
        'product_id' => 'required|unique:products',
        'name' => 'required',
        'price' => 'required|numeric',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('product_images', 'public');
        $validatedData['image'] = $imagePath;
    }

    Product::create($validatedData);
    return redirect()->route('products.index')->with('success', 'Product created successfully');
}

public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'product_id' => 'required|unique:products,product_id,' . $id,
        'name' => 'required',
        'price' => 'required|numeric',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $product = Product::findOrFail($id);

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('product_images', 'public');
        $validatedData['image'] = $imagePath;
    }

    $product->update($validatedData);
    return redirect()->route('products.index')->with('success', 'Product updated successfully');
}
```

#### 4. **Blade Files** (View Files)

-   **Index Page:** `resources/views/products/index.blade.php`
-   এখানে ইমেজ প্রিভিউ করার জন্য একটি কলাম যুক্ত করুন।

    ```html
    <th>Image</th>
    ...
    <td>
        @if($product->image)
        <img
            src="{{ asset('storage/' . $product->image) }}"
            alt="{{ $product->name }}"
            width="50"
        />
        @else No Image @endif
    </td>
    ```

-   **Create and Edit Pages:** `resources/views/products/create.blade.php` এবং `resources/views/products/edit.blade.php`
-   এখানে একটি ফাইল ইনপুট ফিল্ড যোগ করতে হবে।

    ```html
    <div class="form-group">
        <label for="image">Product Image:</label>
        <input type="file" name="image" class="form-control" />
    </div>
    ```

#### 5. **Routes** (web.php)

-   `routes/web.php`
-   যদি রাউটগুলো এখনও না দেওয়া থাকে, তবে নিশ্চিত করুন যে আপনার `Route::resource` এর মাধ্যমে প্রয়োজনীয় রাউট গুলি যুক্ত করা আছে।

```php
Route::resource('products', ProductController::class);
```

---

### Laravel প্রজেক্টের প্রতিটি ধাপের সংক্ষিপ্তসার

1. **মাইগ্রেশন ফাইল তৈরি**: `products` টেবিলে নতুন `image` কলাম যুক্ত করার জন্য।
2. **মডেল আপডেট**: `Product` মডেলের `fillable` অ্যাট্রিবিউটে `image` ফিল্ড যুক্ত করা।
3. **কন্ট্রোলার আপডেট**: ইমেজ আপলোড এবং সঞ্চয় করার জন্য `store` এবং `update` মেথডে পরিবর্তন।
4. **ভিউ ফাইল আপডেট**: প্রোডাক্ট ইমেজ দেখানোর জন্য ইনডেক্স ভিউতে এবং ইমেজ আপলোডের জন্য ক্রিয়েট ও এডিট ভিউতে পরিবর্তন।
5. **রাউটিং নিশ্চিতকরণ**: রিসোর্সফুল রাউটগুলি যেন `web.php` তে ঠিকমত সংযুক্ত থাকে।

এই নির্দেশনা অনুসরণ করে আপনার প্রজেক্টে প্রয়োজনীয় পরিবর্তন সম্পন্ন করতে পারবেন।
ধন্যবাদ! আমি বুঝতে পেরেছি আপনি সম্পূর্ণ কোড সহ প্রতিটি ফাইলের বর্তমান অবস্থার একটি কপি চাচ্ছেন যাতে সমস্ত কোড, পুরানো এবং নতুন অংশগুলি একসাথে থাকে। নিচে প্রতিটি ফাইলের পূর্ণ কোড দিয়েছি, যেখানে আপনার প্রজেক্টের সর্বশেষ আপডেট অনুযায়ী প্রতিটি ফাইলে সমস্ত প্রয়োজনীয় অংশ অন্তর্ভুক্ত করা হয়েছে।

### 1. **Migration File** (Adding `image` Column to `products` Table)

-   ফাইলের নাম হতে পারে: `database/migrations/YYYY_MM_DD_add_image_to_products_table.php`
-   এই মাইগ্রেশনটি `products` টেবিলে `image` কলাম যুক্ত করবে।

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'image')) {
                $table->string('image')->nullable()->after('stock');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
}
```

### 2. **Product Model** (`app/Models/Product.php`)

-   `Product` মডেলে `fillable` অ্যাট্রিবিউটে `image` ফিল্ড যুক্ত করা হয়েছে।

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 'name', 'description', 'price', 'stock', 'image'
    ];
}
```

### 3. **Product Controller** (`app/Http/Controllers/ProductController.php`)

-   এখানে ইমেজ আপলোডের জন্য `store` এবং `update` মেথডে পরিবর্তন করা হয়েছে।

```php
<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(10);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|unique:products',
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product_images', 'public');
            $validatedData['image'] = $imagePath;
        }

        Product::create($validatedData);
        return redirect()->route('products.index')->with('success', 'Product created successfully');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|unique:products,product_id,' . $id,
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = Product::findOrFail($id);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product_images', 'public');
            $validatedData['image'] = $imagePath;
        }

        $product->update($validatedData);
        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
}
```

### 4. **Blade Files**

-   **Index Page:** `resources/views/products/index.blade.php`

    ```html
    <!DOCTYPE html>
    <html>
        <head>
            <title>Product Management</title>
            <link
                rel="stylesheet"
                href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
            />
        </head>
        <body>
            <div class="container">
                <h1>Product List</h1>
                <a
                    href="{{ route('products.create') }}"
                    class="btn btn-primary mb-3"
                    >Create New Product</a
                >
                <table class="table table-bordered">
                    <tr>
                        <th>ID</th>
                        <th>Product ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                    @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->product_id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>
                            @if($product->image)
                            <img
                                src="{{ asset('storage/' . $product->image) }}"
                                alt="{{ $product->name }}"
                                width="50"
                            />
                            @else No Image @endif
                        </td>
                        <td>
                            <a
                                href="{{ route('products.show', $product->id) }}"
                                class="btn btn-info"
                                >View</a
                            >
                            <a
                                href="{{ route('products.edit', $product->id) }}"
                                class="btn btn-warning"
                                >Edit</a
                            >
                            <form
                                action="{{ route('products.destroy', $product->id) }}"
                                method="POST"
                                style="display:inline;"
                            >
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>

                {{ $products->links() }}
            </div>
        </body>
    </html>
    ```

-   **Create and Edit Pages:** `resources/views/products/create.blade.php` এবং `resources/views/products/edit.blade.php`

    ```html
    <!DOCTYPE html>
    <html>
        <head>
            <title>Create/Edit Product</title>
            <link
                rel="stylesheet"
                href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
            />
        </head>
        <body>
            <div class="container">
                <h1>{{ isset($product) ? 'Edit' : 'Create' }} Product</h1>

                <form
                    action="{{ isset($product) ? route('products.update', $product->id) : route('products.store') }}"
                    method="POST"
                    enctype="multipart/form-data"
                >
                    @csrf @if(isset($product)) @method('PUT') @endif

                    <div class="form-group">
                        <label for="product_id">Product ID:</label>
                        <input
                            type="text"
                            name="product_id"
                            class="form-control"
                            value="{{ $product->product_id ?? old('product_id') }}"
                            required
                        />
                    </div>

                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            value="{{ $product->name ?? old('name') }}"
                            required
                        />
                    </div>

                    <div class="form-group">
                        <label for="price">Price:</label>
                        <input
                            type="text"
                            name="price"
                            class="form-control"
                            value="{{ $product->price ?? old('price') }}"
                            required
                        />
                    </div>

                    <div class="form-group">
                        <label for="image">Product Image:</label>
                        <input type="file" name="image" class="form-control" />
                        @if(isset($product) && $product->image)
                        <p>Current Image:</p>
                        <img
                            src="{{ asset('storage/' . $product->image) }}"
                            alt="{{ $product->name }}"
                            width="100"
                        />
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary">
                        {{ isset($product) ? 'Update' : 'Create' }} Product
                    </button>
                </form>
            </div>
        </body>
    </html>
    ```

### 5. **Routes** (`routes/web.php`)

```php
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::resource('products', ProductController::class);
```

### সংক্ষেপে

এই ফাইলগুলো অনুযায়ী আপনার প্রজেক্ট আপডেট করতে পারবেন। প্রতিটি অংশেই বিদ্যমান এবং নতুন কোড যুক্ত করা হয়েছে।
বুঝতে পেরেছি! আপনার ডাটাবেজে ইতিমধ্যে `image` কলাম আছে এবং আপনি নতুন করে মাইগ্রেশন না চালিয়েই আগের কোডে শুধু `image` ফিল্ডের হ্যান্ডলিং যুক্ত করতে চান। তাই নিচে প্রতিটি ফাইলে শুধু `image` ফিল্ড যুক্ত করা হয়েছে, যেন আপনার বিদ্যমান `products` টেবিলের `image` ফিল্ড হ্যান্ডেল করা যায়। এতে নতুন মাইগ্রেশন করার প্রয়োজন হবে না।

### 1. **Product Model** (`app/Models/Product.php`)

-   এখানে `fillable` অ্যাট্রিবিউটে `image` ফিল্ড যুক্ত করা হয়েছে, যাতে `mass assignment` এর সময় `image` ফিল্ড ব্যবহার করা যায়।

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 'name', 'description', 'price', 'stock', 'image'
    ];
}
```

### 2. **Product Controller** (`app/Http/Controllers/ProductController.php`)

-   `store` এবং `update` মেথডে ইমেজ ফাইল আপলোড ও সেভ করার কোড যুক্ত করা হয়েছে।

```php
<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(10);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|unique:products',
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Image handling
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product_images', 'public');
            $validatedData['image'] = $imagePath;
        }

        Product::create($validatedData);
        return redirect()->route('products.index')->with('success', 'Product created successfully');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|unique:products,product_id,' . $id,
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = Product::findOrFail($id);

        // Image handling
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product_images', 'public');
            $validatedData['image'] = $imagePath;
        }

        $product->update($validatedData);
        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
}
```

### 3. **Blade Files**

-   **Index Page:** `resources/views/products/index.blade.php`

    -   এখানে `image` কলাম যুক্ত করা হয়েছে এবং ইমেজ প্রদর্শন করা হয়েছে।

    ```html
    <!DOCTYPE html>
    <html>
        <head>
            <title>Product Management</title>
            <link
                rel="stylesheet"
                href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
            />
        </head>
        <body>
            <div class="container">
                <h1>Product List</h1>
                <a
                    href="{{ route('products.create') }}"
                    class="btn btn-primary mb-3"
                    >Create New Product</a
                >
                <table class="table table-bordered">
                    <tr>
                        <th>ID</th>
                        <th>Product ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                    @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->product_id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>
                            @if($product->image)
                            <img
                                src="{{ asset('storage/' . $product->image) }}"
                                alt="{{ $product->name }}"
                                width="50"
                            />
                            @else No Image @endif
                        </td>
                        <td>
                            <a
                                href="{{ route('products.show', $product->id) }}"
                                class="btn btn-info"
                                >View</a
                            >
                            <a
                                href="{{ route('products.edit', $product->id) }}"
                                class="btn btn-warning"
                                >Edit</a
                            >
                            <form
                                action="{{ route('products.destroy', $product->id) }}"
                                method="POST"
                                style="display:inline;"
                            >
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>

                {{ $products->links() }}
            </div>
        </body>
    </html>
    ```

-   **Create and Edit Pages:** `resources/views/products/create.blade.php` এবং `resources/views/products/edit.blade.php`

    -   ইমেজ ফাইল আপলোড করার জন্য `input` ফিল্ড যুক্ত করা হয়েছে।

    ```html
    <!DOCTYPE html>
    <html>
        <head>
            <title>Create/Edit Product</title>
            <link
                rel="stylesheet"
                href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
            />
        </head>
        <body>
            <div class="container">
                <h1>{{ isset($product) ? 'Edit' : 'Create' }} Product</h1>

                <form
                    action="{{ isset($product) ? route('products.update', $product->id) : route('products.store') }}"
                    method="POST"
                    enctype="multipart/form-data"
                >
                    @csrf @if(isset($product)) @method('PUT') @endif

                    <div class="form-group">
                        <label for="product_id">Product ID:</label>
                        <input
                            type="text"
                            name="product_id"
                            class="form-control"
                            value="{{ $product->product_id ?? old('product_id') }}"
                            required
                        />
                    </div>

                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            value="{{ $product->name ?? old('name') }}"
                            required
                        />
                    </div>

                    <div class="form-group">
                        <label for="price">Price:</label>
                        <input
                            type="text"
                            name="price"
                            class="form-control"
                            value="{{ $product->price ?? old('price') }}"
                            required
                        />
                    </div>

                    <div class="form-group">
                        <label for="image">Product Image:</label>
                        <input type="file" name="image" class="form-control" />
                        @if(isset($product) && $product->image)
                        <p>Current Image:</p>
                        <img
                            src="{{ asset('storage/' . $product->image) }}"
                            alt="{{ $product->name }}"
                            width="100"
                        />
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary">
                        {{ isset($product) ? 'Update' : 'Create' }} Product
                    </button>
                </form>
            </div>
        </body>
    </html>
    ```

### 4. **Routes** (`routes/web.php`)

```php
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::resource('products', ProductController::class);
```

এভাবে আপনার প্রজেক্টে `image` ফিল্ডের জন্য প্রয়োজনীয় পরিবর্তনগুলি যুক্ত করা হয়েছে, যা আপনার পূর্বের ডাটাবেজের সাথে কাজ করবে এবং নতুন মাইগ্রেশন চালানোর প্রয়োজন নেই।
