import React, {useEffect, useState} from 'react';
import axios from "axios";

import classes from "../styles/main.module.css"
import {Link, useNavigate} from "react-router-dom";
import {useForm} from "react-hook-form";
import {useContext} from "react";
import {Loading} from "../context";
import BookElement from "./BookElement";
import DvdElement from "./DvdElement";
import FurnitureElement from "./FurnitureElement";





 const PostProduct = () => {

     const {setLoading} = useContext(Loading);
     const [extraFields, setExtraFields] = useState();
     const [SpecialField, setSpecialField] = useState();


     const {
             register,
             watch,
             formState:{errors,isValid},
             handleSubmit,
             getValues,
             setValue,
             value
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



     useEffect(() => {
         setValue("specialField", SpecialField);
     }, [SpecialField])

        //check exist sku
         const [skuL,setSku]=useState([]);
         function getSkuList(){
             axios.get(`http://localhost/FINALA/back_end/public/sku`)
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
            axios.post(`http://localhost/FINALA/back_end/public/add`, data)
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


                 <select
                        defaultValue={""}
                      id="productType"
                      {...register("productType", { required:true })}
                        onChange={(e) => {
                            setSpecialField(null);
                            const components = {
                                "Book": BookElement ,
                                "DVD": DvdElement,
                                "Furniture": FurnitureElement
                            }
                            let Component = components[e.target.value];
                            setExtraFields(<Component setValue={setSpecialField} />);
                        }}
                 >
                     <option value="" disabled>Type Switcher</option>
                     <option  value="Book" id="Book" >Book</option>
                     <option value="DVD" id="DVD" >DVD</option>
                     <option value="Furniture" id="Furniture" >Furniture</option>
                 </select>
                 <input
                     type="text"
                      style={{display:"none"}}
                     {...register('specialField', {required: true})}/>
                 {extraFields}
             </div>
         </form>

     );
 };

export default PostProduct;
