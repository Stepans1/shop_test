import React, {useEffect, useState} from 'react';
import axios from "axios";
import ProductsList from "./ProductsList";
//import classes from "./Products.module.css";
import classes from "../styles/main.module.css"
import {Link} from "react-router-dom";

const GetProducts = function () {
    const [products, setProducts] = useState([]);
    useEffect(()=> {
        axios.get('http://188.92.78.91:8080/')
            .then(response => {
                setProducts(response.data);
            });

    });

    const [ids, setIds] = useState('');
    function deleteProducts() {
        axios.delete(`http://188.92.78.91:8080/${ids}`)
            .then(response => {
                return response;
            });
    }


    const setIdToDelete = (id) => {
        if(ids.includes(id)) {
            setIds(ids.replace(id + ',', ''));
        } else {
            setIds(ids + id + ',');
        }
    }


return (
    <div>
        <header>
            <h1>Product list</h1>
            <div className={classes.buttons}>
                <button ><Link to='/addproduct'>ADD</Link></button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                <button id="delete-product-btn" onClick={deleteProducts}>MASS DELETE</button>
            </div>
            <hr/>
        </header>

        <div className={classes.productList}>
            {products.length ?
            products.map((product) =>
                <ProductsList key={product.id} id={product.id} name={product.name} sku={product.sku} price={product.price} productType={product.productType} dimension={product.dimension} size={product.size} weight={product.weight} onChange={() => setIdToDelete(product.id)}/>
                )
                :
                <p>asd</p>
            }
        </div>
    </div>
    );
}



export default GetProducts;