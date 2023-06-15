import React, {useEffect, useState} from 'react';
import axios from "axios";

import classes from "../styles/main.module.css"
import {Link, useNavigate} from "react-router-dom";
import {useForm} from "react-hook-form";
import {useContext} from "react";
import {Loading} from "../context";





 const PostProduct = () => {

     const {setLoading} = useContext(Loading);

     const {
             register,
             watch,
             formState:{errors,isValid},
             handleSubmit
         }=useForm({
             mode:"onBlur",
             defaultValues: {
                 productType: ""
             }
         });
         const onSubmit = (data)=>
         {
             postProducts(data);
         };



//check exist sku
         const [skuL,setSku]=useState([]);

         function getSkuList(){
             axios.get(`http://localhost/revork/back-end/public/sku`)
                 .then(response => {
                     setSku(response.data);
                 });
         }

         useEffect(()=>{
             getSkuList();
         }, []);
     function skuValidation(sku) {
         return skuL.includes(sku);
     }
     const navigate = useNavigate();
    //add product
     async function postProducts(data) {
        await getSkuList();
        if(skuValidation(data.sku) === true){
         

        } else {
            setLoading(true);
            axios.post(`http://localhost/revork/back-end/public/save`, data)
                .then(() => {
                    setLoading(false);
                });
            navigate("/");
        }



     }

     return (

         <form id="product_form" onSubmit={handleSubmit(onSubmit)}>

             <div>
                 <header>
                     <h1>Product Add</h1>
                     <div className={classes.buttons}>
                         <button onClick={skuValidation}  type="submit" >Save</button>
                         &nbsp;&nbsp;&nbsp;
                         <button><Link to='/'>Cancel</Link></button>

                     </div>
                     <hr/>
                 </header>
                 <br/>
                 <br/>
                 <div>
                     <label>SKU </label>
                     <input
                         {...register("sku", {
                             required: "Please, submit required data",
                             validate:(v)=>{
                                 if(skuValidation(v)===true){
                                    return "Sku must be unique ";
                                 }
                             }

                         })}
                         id='sku'
                         type="text"
                         placeholder="sku"/>
                     <br/><br/>
                     <div>
                         {errors?.sku && <p> {errors?.sku?.message || "Error!"} </p>}
                     </div>
                 </div>
                 <div>
                     <label>Name </label>
                     <input
                         {...register("name", {
                             required: "Please, submit required data",

                         })}
                         id='name'
                         type="text"
                         placeholder="name"
                     /><br/><br/>
                     <div>
                         {errors?.name && <p> {errors?.name?.message || "Error!"} </p>}
                     </div>
                 </div>
                 <div>
                     <label>Price </label>
                     <input
                         {...register("price", {
                             required: "Please, submit required data",
                             pattern: {
                                 value: /^(0|[1-9]\d*)(\.\d+)?$/,
                                 message: 'Please, provide the data of indicated type'
                             }
                         })}

                         id='price'
                         placeholder="price"
                     /> <br/><br/>
                     <div>
                         {errors?.price && <p> {errors?.price?.message || "Error!"} </p>}
                     </div>
                 </div>

                 <label>Type Switcher </label>
                 {/*<Select*/}
                 {/*    {...register("productType", {*/}
                 {/*        required: "Please, submit required data",*/}
                 {/*    })}*/}
                 {/*    id='productType'*/}
                 {/*    value={watch('productType')}*/}
                 {/*    defaultValue="Type Switcher"*/}
                 {/*    options={[*/}
                 {/*        {value: 'Book', name: 'Book'},*/}
                 {/*        {value: 'DVD', name: 'DVD'},*/}
                 {/*        {value: 'Furniture', name: 'Furniture'}*/}
                 {/*    ]}*/}

                 {/*/>*/}
                 <select
                     id="productType"
                     {...register("productType", { required:"Please, submit required data" })}
                 >
                     <option value="" disabled>Type Switcher</option>
                     <option value="Book" id="Book" >Book</option>
                     <option value="DVD" id="DVD" >DVD</option>
                     <option value="Furniture" id="Furniture" >Furniture</option>
                 </select>


                 {
                     watch('productType')==='Book'?(
                         <div>
                             <label>Weight </label>
                             <input
                                 {...register("weight", {
                                     required: "Please, submit required data",
                                     pattern: {
                                         value: /^(0|[1-9]\d*)(\.\d+)?$/,
                                         message: 'Please, provide the data of indicated type'
                                     }
                                 })}
                                 id='weight'

                                 placeholder="Please, provide weight"
                             />
                             <div>
                                 {errors?.weight && <p> {errors?.weight?.message || "Error!"} </p>}
                             </div>
                         </div>

                     // ) : watch('productType') === 'DVD' ? (
                     //     <div>
                     //         <label>Size </label>
                     //         <input
                     //             {...register("size", {
                     //                 required: true,
                     //                 pattern: {
                     //                     value: /^(0|[1-9]\d*)(\.\d+)?$/,
                     //                     message: 'Please, provide the data of indicated type'
                     //                 }
                     //             })}
                     //             id='size'
                     //
                     //             placeholder="Please, provide size"
                     //         />
                     //         <div>
                     //             {errors?.size && <p> {errors?.size?.message || "Please, submit required data"} </p>}
                     //         </div>
                     //     </div>
                     // ) : watch('productType') === 'Furniture' ? (
                     //     <p>
                     //         <label>Height (CM)&nbsp;</label>
                     //         <input
                     //             {...register("height", {
                     //                 required: "Please, submit required data",
                     //                 pattern: {
                     //                     value: /^(0|[1-9]\d*)(\.\d+)?$/,
                     //                     message: 'Please, provide the data of indicated type'
                     //                 }
                     //             })}
                     //             id='height'
                     //
                     //             placeholder="Please, provide height"
                     //         />
                     //         <div>
                     //         {errors?.height && <p> {errors?.height?.message || "Error!"} </p>}
                     //         </div><br/>
                     //         <label>Width (CM)&nbsp;&nbsp;</label>
                     //         <input
                     //             {...register("width", {
                     //                 required: "Please, submit required data",
                     //                 pattern: {
                     //                     value: /^(0|[1-9]\d*)(\.\d+)?$/,
                     //                     message: 'Please, provide the data of indicated type'
                     //                 }
                     //             })}
                     //             id='width'
                     //
                     //             placeholder="Please, provide width"
                     //         />
                     //         <div>
                     //         {errors?.width && <p> {errors?.width?.message || "Error!"} </p>}
                     //         </div><br/>
                     //         <label>Length (CM)&nbsp;</label>
                     //         <input
                     //             {...register("length", {
                     //                 required: "Please, submit required data",
                     //                 pattern: {
                     //                     value: /^(0|[1-9]\d*)(\.\d+)?$/,
                     //                     message: 'Please, provide the data of indicated type'
                     //                 }
                     //             })}
                     //             id='length'
                     //
                     //             placeholder="Please, provide length"
                     //         />
                     //         <div>
                     //             {errors?.length && <p> {errors?.length?.message || "Error!"} </p>}
                     //         </div>
                     //     </p>
                     ) : (<p></p>)
                 }

             </div>
         </form>

     );
 };

export default PostProduct;
