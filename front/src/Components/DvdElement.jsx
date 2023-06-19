
import React, {useEffect, useState} from 'react';
const DvdElement = ({setValue}) => {
    const [error, setError] = useState();

    const validate = (v) => {
        const pattern = /^(0|[1-9]\d*)(\.\d+)?$/;

        if(pattern.test(v)) {
            setError();
            setValue("Weight: " + v + "KG");
        } else {
            setError("Please, provide the data of indicated type");
            setValue('error');
        }
    }
    return (
        <div>
            <label>Weight (KG)</label>
            <input
                id="weight"
                placeholder='Weight'
                onChange={(e) => validate(e.target.value)}

            />
            <div >
                {error && <p>{error}</p>}
            </div>
        </div>
    );
};

export default DvdElement;