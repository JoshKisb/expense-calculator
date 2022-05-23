import axios from "axios";
import { useEffect, useState } from "react";
import { Category } from "../interfaces/Category";

interface ResultTableProps {
	categories: Category[];
}
const enum SortDirection {
	// Unsorted,
	Asc,
	Desc,
}

const ResultTable: React.FC<ResultTableProps> = ({ categories }) => {
	const [displayCategories, setDisplayCategories] = useState(categories);
	const [sortDir, setSortDir] = useState(SortDirection.Desc);

	const toggleSortDir = () => {
		setSortDir((state) =>
			state === SortDirection.Desc
				? SortDirection.Asc
				: SortDirection.Desc
		);
	};

	useEffect(() => {
		let sorted;
		if (sortDir === SortDirection.Asc) {
			sorted = categories.concat().sort((a, b) => {
				return a.amount - b.amount;
			});
		} else {
			sorted = categories.concat().sort((a, b) => {
				return b.amount - a.amount;
			});
		}
		setDisplayCategories(sorted);				
	}, [sortDir]);

	return (
		<div className="d-flex result-table">
			<div className="table-responsive w-100">
				<table className="table table-striped">
					<thead className="table-dark">
						<tr>
							<th>Category</th>
							<th>
								<div
									onClick={toggleSortDir}
									className="sortable-header"
								>
									<p>Amount</p>
									<div
										className={`arrow-${
											sortDir === SortDirection.Desc
												? "down"
												: "up"
										}`}
									></div>
								</div>
							</th>
						</tr>
					</thead>
					<tbody>
						{displayCategories.length > 0 ? (
							<>
								{displayCategories.map((category) => (
									<tr key={category.name}>
										<td>{category.name}</td>
										<td>
											{category.amount.toLocaleString(
												"en-US"
											)}
										</td>
									</tr>
								))}
							</>
						) : (
							<tr>
								<td colSpan={2}>
									<p className="text-center pt-2">
										No categories available
									</p>
								</td>
							</tr>
						)}
					</tbody>
				</table>
			</div>
		</div>
	);
};

export default ResultTable;
