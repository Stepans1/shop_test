
import React, {useEffect, useState} from 'react';
const DvdElement = ({setValue}) => {
    const [error, setError] = useState();

    //chek data from input
    const validate = (v) => {
        const pattern = /^(0|[1-9]\d*)(\.\d+)?$/;

        if(pattern.test(v)) {
            setError();
            setValue("Size: " + v + " MB");
        } else {
            setError("Please, provide the data of indicated type");
            setValue("");
        }
    }
    return (
        <div>
            <label>Size (MB)</label>
            <input
                id="size"
                placeholder='Please, provide size'
                onChange={(e) => validate(e.target.value)}
            />
            <div >
                {error && <p>{error}</p>}
            </div>
        </div>
    );
};

export default DvdElement;