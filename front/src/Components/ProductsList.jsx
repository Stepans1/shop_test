import React, {useEffect, useState} from 'react';
import classes from "../styles/main.module.css"



const ProductsList = ({id,name,sku,price,productType,spec,...props}) => {
    if (id != null) {
        return (

            <div className={classes.product} key = {id}>
                <input className='delete-checkbox' type="checkbox" {...props} />
                <h5>{sku}</h5>
                <p>{name}</p>
                <p>{price} $</p>
                {/*<p>{productType}</p>*/}
                <p>{spec}</p>
                {/*<p>{dimension}{size}{weight}</p>*/}
                {/*<button onClick={deleteProduct}>Delete</button>*/}

            </div>
        );
    }
    else {
        return (
            <h1>Product list is empty </h1>
        )
    }

};

export default ProductsList;
