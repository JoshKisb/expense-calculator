import { useRef } from "react";

interface FormProps {
	onSubmit: (values: FormData) => void;
}

const Form: React.FC<FormProps> = ({ onSubmit }) => {
	const formRef = useRef<HTMLFormElement>(null);

	const handleSubmit = (e: React.FormEvent<HTMLFormElement>) => {
		e.preventDefault();
		const form = formRef.current;
		if (!form) return;
		const formData = new FormData(form);
		onSubmit(formData);
		form.reset();
	};
	return (
		<div className="csv-form">
			<form className="form" ref={formRef} onSubmit={handleSubmit}>
				<div>
					<label htmlFor="csv" className="form-label">
						Select CSV File with the expenses data
					</label>
					<input
						className="form-control form-control-lg"
						name="csv"
						id="csv"
						type="file"
					/>
				</div>
				<div className="mt-3 d-flex justify-content-end">
					<button type="submit" className="btn btn-primary">
						Upload
					</button>
				</div>
			</form>
		</div>
	);
};

export default Form;
