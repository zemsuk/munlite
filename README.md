# munlite

Munlite is a PHP framework. It's a light weight framework. Ideal for Headless CMS.

## Query Builder Examples (Content Model)

### Get All Records
```php
Content::get();
```

### Find by ID
```php
Content::find(1);
Content::where('id', 1)->first();
```

### Select Specific Columns
```php
Content::select('id', 'title', 'details')->get();
```

### Where Condition
```php
Content::where('status', 1)->get();
Content::where('type', '=', 'news')->get();
```

### Multiple Where Conditions
```php
Content::where('status', 1)->where('type', 'news')->get();
```

### Or Where
```php
Content::where('status', 1)->orWhere('type', 'blog')->get();
```

### Where In
```php
Content::whereIn('id', [1, 2, 3, 4, 5])->get();
Content::whereIn('type', ['news', 'blog'])->get();
```

### Where Between
```php
Content::whereBetween('id', [1, 10])->get();
```

### Order By
```php
Content::orderBy('id', 'DESC')->get();
Content::where('status', 1)->orderBy('title', 'ASC')->get();
```

### Create Record
```php
Content::create([
    'title' => 'New Post',
    'details' => 'Content details here',
    'type' => 'news',
    'status' => 1
]);
```

### Update Record
```php
Content::update(1, [
    'title' => 'Updated Title',
    'details' => 'Updated details'
]);
```

### Delete Record
```php
Content::delete(1);
```

### Chained Example
```php
Content::select('id', 'title', 'details')
    ->where('status', 1)
    ->whereIn('type', ['news', 'blog'])
    ->orderBy('id', 'DESC')
    ->get();
```