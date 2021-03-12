# artisan-make-crud
使用 Laravel Artisan 自定義樣板產生 CRUD RESTful API 範本

##  如何使用 Laravel Artisan 建立 CRUD API 範本

---

## 前言
後台管理系統通常由 CRUD  所組成, 既然 <font color='red'>**行為**</font> 一樣, 何不節省一些時間, 我們將重複的程式碼(行為)整理好,包裝成簡單的架構範本(RESTful API), 再透過 Laravel Artisan make 出來, 接下來我們只需要將商業邏輯與輸入輸出控制好即可 

---

## 為什麼要做這個工具?
1. ~~懶~~

---

### 更正.....
 時間很寶貴的
1. 節省複製貼上
1. 節省手工建檔的的時間、命名錯誤的低級錯誤
1. 維持一併的開發格式。

---

## 目標

使用 PHP Artisan make:command

1. 建立 Controller：控制好輸入輸出(參數驗證),錯誤擷取
2. 建立 Service：實現商務邏輯
3. 建立 Repository：實現各種商務邏輯對應的資料庫操作方法。

### 實作 Controller、Service、Repository、Route 指令與樣板

```php=
php artisan make:custom-controller {name}
```
```php=
php artisan make:Service {name}
```
```php=
php artisan make:Repository {name}
```

**2.製作一個整合的指令將三個樣板建立、並自動生成路由**
```php=
php artisan make:crud
```
---
## 如何使用
執行指令: ```php artisan make:crud```
將會在 app/Http/Controller、app/Http/Service、app/Http/Repository 產出程式
並自動將路由加入 api.php 

![](https://i.imgur.com/BfZjUCI.png)
