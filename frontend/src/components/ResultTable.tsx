import { Category } from "../interfaces/Category";

interface ResultTableProps {
	categories: Category[];
}

const ResultTable: React.FC<ResultTableProps> = ({ categories }) => {
	return (
		<div className="d-flex result-table">
			<div className="table-responsive w-100">
				<table className="table table-striped">
					<thead className="table-dark">
						<tr>
							<th>Category</th>
							<th>Amount</th>
						</tr>
					</thead>
					<tbody>
						{categories.length > 0 ? (
							<>
								{categories.map((category) => (
									<tr>
										<td>{category.name}</td>
										<td>{category.amount}</td>
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
