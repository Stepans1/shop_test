import React, {useEffect, useState} from 'react';
import { useForm } from "react-hook-form";


const FurnitureElement = ({setValue}) => {


    const {
        register,
        formState: { errors, isValid },
        handleSubmit,
        watch
    } = useForm({
        mode: "onBlur"
    });
    //chek if data is correct and set values which goes to post method
    useEffect(() => {
        validate();
    }, [watch]);

    function validate() {
        if(isValid) {
            handleSubmit(onSubmit)();
        }
    }
    const onSubmit = (data) => {

        setValue("Dimension: " + data.height + "x" + data.width + "x" + data.length);
    }

    return (
        <form onSubmit={handleSubmit(onSubmit)}>
            <div>

                <label>Height (CM)</label>
                <input

                    id="height"
                    placeholder='Please, provide height'
                    {...register('height', {
                        required: "Please, submit required data",
                        onChange:()=>validate(),
                        pattern: {
                            value: /^(0|[1-9]\d*)(\.\d+)?$/,
                            message: 'Please, provide the data of indicated type'
                        }
                    })}

                />

                <div>
                    {errors?.height && <p> {errors?.height?.message || "Error!"} </p>}
                </div>
            </div>
            <div>
                <label>Width (CM)</label>
                <input

                    id="width"
                    placeholder='Please, provide width'
                    {...register('width', {
                        required: "Please, submit required data",
                        onChange:()=>validate(),
                        pattern: {
                            value: /^(0|[1-9]\d*)(\.\d+)?$/,
                            message: 'Please, provide the data of indicated type'
                        }
                    })}

                />
                <div>
                    {errors?.width && <p> {errors?.width?.message || "Error!"} </p>}
                </div>
            </div>
            <div>
                <label>Length (CM)</label>
                <input

                    id="length"
                    placeholder='Please, provide length'
                    {...register('length', {
                        required: "Please, submit required data",
                        onChange:()=>validate(),
                        pattern: {
                            value: /^(0|[1-9]\d*)(\.\d+)?$/,
                            message: 'Please, provide the data of indicated type'
                        }
                    })}

                />
                <div>
                    {errors?.length && <p> {errors?.length?.message || "Error!"} </p>}
                </div>
            </div>

        </form>
    );
};

export default FurnitureElement;