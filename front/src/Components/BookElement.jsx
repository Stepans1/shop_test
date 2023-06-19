import React, {useState} from 'react';
import {useForm} from "react-hook-form";


const BookElement = ({setValue } ) => {

    const [error, setError] = useState();

    //chek data from input
    const validate = (v) => {
        const pattern = /^(0|[1-9]\d*)(\.\d+)?$/;

        if(pattern.test(v)) {
             setError();
            setValue("Weight: " + v + "KG");
        } else {
            setError("Please, provide the data of indicated type");
           setValue("");
        }

    }

    return (
        <div>
                        <label>Weight  (KG)</label>
                        <input
                            id='weight'
                             onChange={(e) => validate(e.target.value)}
                            placeholder="Please, provide weight"
                        />
                        <div>
                            {error && <p>{error}</p>}
                        </div>
                    </div>
    );
};

export default BookElement;