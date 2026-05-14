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

### Group By
```php
Content::select('type', 'COUNT(*) as total')->groupBy('type')->get();
```

### Limit & Offset (Pagination)
```php
Content::orderBy('id', 'DESC')->limit(10)->offset(0)->get();
```

### Join
```php
User::select('user.id', 'user.name', 'content.title')
    ->leftJoin('content', 'user.id', '=', 'content.user_id')
    ->get();
```

### Aggregate Functions
```php
Content::count();
Content::count('id');
Content::where('status', 1)->count();
Content::max('id');
Content::min('id');
Content::avg('id');
Content::sum('id');
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
Content::where('id', 1)->update([
    'title' => 'Updated Title',
    'details' => 'Updated details'
]);

Content::where('status', 0)->update([
    'status' => 1
]);
```

### Delete Record
```php
Content::where('id', 1)->delete();
Content::where('status', 0)->delete();
```

### Chained Example
```php
Content::select('id', 'title', 'details')
    ->where('status', 1)
    ->whereIn('type', ['news', 'blog'])
    ->orderBy('id', 'DESC')
    ->limit(10)
    ->get();
```

### Raw Queries in whereIn/whereBetween
```php
Content::whereIn('id', [1, 2, 3])->get();
Content::orWhereIn('id', [4, 5, 6])->get();
Content::whereBetween('id', [1, 10])->get();
```