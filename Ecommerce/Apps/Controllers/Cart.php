<?php
namespace Apps\Controllers;
use \Core\View;
use Apps\Models\User;
class Cart extends \Core\Controller {
    public function generateAction() {
        $checked = UserConfig::isLoginAction();
        if ($checked) {
            $jsonData = (array)json_decode($_POST['obj']);
            $useExistsInCart = $this->checkUserExistsInCart();
            $totalAmount = 0;
            $totalAmount = $this->fetchTotalAmount();
            $productPrice = $this->fetchPrice($jsonData['productId']);
            $totalAmount = $this->calculateTotalAmount($totalAmount['total_amount'], $productPrice['productPrice'], $jsonData['qty']);
            if ($useExistsInCart) {
                $updateData['total_amount'] = $totalAmount;
                $updateData['updatedAt'] = date("d-m-y h:i:s");
                $table = 'cart';
                $where = "cartId = " . $_SESSION['cartId'] . " AND custId = " . $_SESSION['custId'];
                $result = $this->updateAction($updateData, $table, $where);
            } else {
                $data = $this->mainCartCleanArray($totalAmount);
                $data['createdAt'] = date("d-m-y h:i:s");
                $data['status'] = 1;
                $table = 'cart';
                $result = $this->addAction($data, $table);
                if ($result > 0) {
                    $_SESSION['cartId'] = $result;
                }
            }
            if ($result > 0) {
                $productExistsInCart = $this->checkProductExistsInCart($jsonData['productId']);
                if ($productExistsInCart) {
                    $updateData = [];
                    $updateData['amount'] = $productPrice['productPrice'];
                    $updateData['quantity'] = $productExistsInCart['quantity'] + $jsonData['qty'];
                    $updateData['updatedAt'] = date("d-m-y h:i:s");
                    $table = 'cart_items';
                    $where = "cartId = " . $_SESSION['cartId'] . " AND product_id = " . $jsonData['productId'];
                    $result = $this->updateAction($updateData, $table, $where);
                } else {
                    $dataItems = $this->cartItemsCleanArray($productPrice['productPrice'], $jsonData['qty'], $jsonData['productId']);
                    $dataItems['createdAt'] = date("d-m-y h:i:s");
                    $table = 'cart_items';
                    $result = $this->addAction($dataItems, $table);
                }
                if ($result == 0) {
                    echo "Error While adding to cart";
                } else {
                    echo "Added to Cart";
                }
            } else {
                echo "Error While adding to cart";
            }
        } else {
            $_SESSION['errorMessage'] = "Please Login First ";
            USerConfig::redirect('/public/home');
        }
    }
    public function addAction($data, $table) {
        $result = User::insert($data, $table);
        return $result;
    }
    public function updateAction($updateData, $table, $where) {
        $result = User::update($updateData, $where, $table);
        return $result;
    }
    public function fetchPrice($id) {
        $query = "SELECT productPrice FROM products WHERE productId = $id";
        $price = User::fetchRow($query);
        return $price;
    }
    public function fetchTotalAmount() {
        if (array_key_exists('cartId', $_SESSION)) {
            $query = "SELECT total_amount FROM cart WHERE cartId = " . $_SESSION['cartId'] . " AND custId = " . $_SESSION['custId'];
            $totalAmount = User::fetchRow($query);
        } else {
            $totalAmount = 0;
        }
        return $totalAmount;
    }
    public function calculateTotalAmount($totalAmount, $productPrice, $qty) {
        return (($totalAmount == 0) ? 0 : $totalAmount) + ($productPrice * $qty);
    }
    public function mainCartCleanArray($totalAmount) {
        $data = [];
        $data['custId'] = $_SESSION['custId'];
        $data['total_amount'] = $totalAmount;
        return $data;
    }
    public function cartItemsCleanArray($price, $qty, $productId) {
        $data = [];
        $data['cartId'] = $_SESSION['cartId'];
        $data['product_id'] = $productId;
        $data['quantity'] = $qty;
        $data['amount'] = $price;
        return $data;
    }
    public function checkUserExistsInCart() {
        // unset($_SESSION['cartId']);
        // print_r($_SESSION);
        // die();
        if (array_key_exists('cartId', $_SESSION) && $_SESSION['cartId'] != null) {
            $query = "SELECT * FROM cart WHERE cartId = " . $_SESSION['cartId'];
            $result = User::fetchRow($query);
            if ($result != false) {
                return true;
            } else {
                return false;
            }
        } else {
            $query = "SELECT * FROM cart WHERE status = 1 AND custId = " . $_SESSION['custId'];
            $result = User::fetchRow($query);
            if ($result != 0) {
                if (array_key_exists('cartId', $_SESSION) == false) {
                    $_SESSION['cartId'] = $result['cartId'];
                    return true;
                }
            } else {
                return false;
            }
        }
    }
    public function checkProductExistsInCart($productId) {
        if (array_key_exists('cartId', $_SESSION) && $_SESSION['cartId'] != null) {
            $query = "SELECT quantity FROM cart_items WHERE cartId = " . $_SESSION['cartId'] . " AND product_id = $productId";
            $result = User::fetchRow($query);
            return $result;
        } else {
            return false;
        }
    }
    public function viewAction() {
        if (array_key_exists('cartId', $_SESSION) == false) {
            $fields = ['cartId', 'total_amount'];
            $fields = implode(',', $fields);
            $where = "custId =" . $_SESSION['custId'] . " AND status = 1";
        } else {
            $fields = 'total_amount';
            $where = "cartId = " . $_SESSION['cartId'];
        }
        $query1 = "SELECT $fields FROM cart WHERE $where";
        $result1 = User::fetchRow($query1);
        if (array_key_exists('cartId', $_SESSION) == false) {
            $_SESSION['cartId'] = $result1['cartId'];
        }
        $query2 = "
                    SELECT 
                        CI.amount,
                        P.productName,
                        P.productImage,
                        CI.quantity,
                        CI.cartId,
                        P.productId
                    FROM 
                        cart_items CI 
                    INNER JOIN
                        products P 
                    on
                        CI.product_id = P.productId
                    WHERE
                        CI.cartId = 
                    " . $_SESSION['cartId'];
        $result2 = User::fetchAll($query2);
        echo "<div style='margin-top: 1%;'>";
        if (empty($result2)) {
            echo "No Products Available in Cart";
        } else {
            $imgLocation = $_SESSION['base_url'] . "/resources/uploads/products/";
            $deleteLocation = $_SESSION['base_url'] . "/public/cart/delete";
            echo "<table class='w3-table-all w3-hoverable' id='displayCart'>";
            echo " <tr>
                        <th>Product</th>
                        <th>Image</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>";
            foreach ($result2 as $data) {
                echo "
                    <tr>
                        <td >" . $data['productName'] . "</td>
                        <td><img src='" . $imgLocation . $data['productImage'] . "' height=60 width=60 alt=" . $data['productName'] . "></td>
                        <td  >" . $data['quantity'] . "</td>
                        <td > &#x20b9; " . $data['amount'] . "</td>
                        <td > &#x20b9; " . ($data['amount'] * $data['quantity']) . "</td>
                        <td style='text-align:center'>
                        <div class='tooltip'>
                            <form method=post action =$deleteLocation>
                                <input type=hidden value=" . $data['productId'] . " name=pid>
                                <input type='submit' class='fa fa-lg ' id=trash onclick='return confirmation()' value=&#xf1f8;>
                                <span class='tooltiptext'>Delete</span>
                            </form> 
                        </div> 
                        </td>
                  </tr>
             ";
            }
            echo "</table>";
            echo "<p  class='total-price'>Total Amount: &#x20b9; " . $result1['total_amount'] . "</p>";
        }
        echo "</div>";
    }
}
