import axios from "axios";
import { useEffect, useState } from "react";
import { Category } from "../interfaces/Category";
import Form from "./Form";
import Loading from "./Loading";
import ResultTable from "./ResultTable";

const Display: React.FC = () => {
	const [loading, setLoading] = useState(false);
	const [categories, setCategories] = useState<Category[]>([]);
	const [showTable, setShowTable] = useState(false);
	const [error, setError] = useState("");

	const uploadCSV = (formData: FormData) => {
		const apiUrl = import.meta.env.VITE_API_URL;
		const url = `${apiUrl}/upload.php`;

		setLoading(true);
		axios
			.post(url, formData)
			.then((res) => {
				console.log(res.data);
				setCategories(res.data.categories);
				setShowTable(true);
			})
			.catch((err) => {
				console.log("err", err);
				if (err.response?.status === 400) {
					const message = err.response?.data?.error?.[0];
					setError(message);
				} else {
					setError(err.message);
				}
			})
			.finally(() => {
				setLoading(false);
			});
	};

	useEffect(() => {
		let timer: number;
		if (!!error) {
			timer = setTimeout(() => {
				setError("");
			}, 8000);
		}
		// clear timeout... not sure if... hmm
		// return () => {
		// 	if (!!timer)
		// 		clearTimeout(timer);
		// };
	}, [error]);

	const renderPage = () => {
		if (loading) {
			return <Loading />;
		} else if (showTable) {
			return (
				<div>
					<button
						onClick={() => setShowTable(false)}
						className="btn btn-outline-secondary"
					>
						&larr; back
					</button>
					<ResultTable categories={categories} />
				</div>
			);
		} else {
			return (
				<div>
					{!!error && (
						<div className="csv-form mb-0">
							<div className="alert alert-danger" role="alert">
								{error}
							</div>
						</div>
					)}
					<Form onSubmit={uploadCSV} />
				</div>
			);
		}
	};

	return <div className="content">{renderPage()}</div>;
};

export default Display;
