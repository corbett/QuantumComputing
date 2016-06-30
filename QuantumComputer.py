#!/usr/bin/env python
# Author: corbett@caltech.edu

import numpy as np
import unittest
import re
import random
import exceptions
import itertools
from math import sqrt,pi,e,log
import time
####
## Gates
####
class Gate(object):
	i_=np.complex(0,1)
	## One qubit gates
	# Hadamard gate
	H=1./sqrt(2)*np.matrix('1 1; 1 -1') 
	# Pauli gates
	X=np.matrix('0 1; 1 0')
	Y=np.matrix([[0, -i_],[i_, 0]])
	Z=np.matrix([[1,0],[0,-1]])

	# Defined as part of the Bell state experiment
	W=1/sqrt(2)*(X+Z)
	V=1/sqrt(2)*(-X+Z)
	
	# Other useful gates
	eye=np.eye(2,2)

	S=np.matrix([[1,0],[0,i_]])
	Sdagger=np.matrix([[1,0],[0,-i_]]) # convenience Sdagger = S.conjugate().transpose()

	T=np.matrix([[1,0],[0, e**(i_*pi/4.)]])
	Tdagger=np.matrix([[1,0],[0, e**(-i_*pi/4.)]]) # convenience Tdagger= T.conjugate().transpose()


	# TODO: for CNOT gates define programatically instead of the more manual way below
	## Two qubit gates
	# CNOT Gate (control is qubit 0, target qubit 1), this is the default CNOT gate
	CNOT2_01=np.matrix('1 0 0 0; 0 1 0 0; 0 0 0 1; 0 0 1 0')
	# control is qubit 1 target is qubit 0 
	CNOT2_10=np.kron(H,H)*CNOT2_01*np.kron(H,H) #=np.matrix('1 0 0 0; 0 0 0 1; 0 0 1 0; 0 1 0 0') 

	# operates on 2 out of 3 entangled qubits, control is first subscript, target second
	CNOT3_01=np.kron(CNOT2_01,eye)
	CNOT3_10=np.kron(CNOT2_10,eye)
	CNOT3_12=np.kron(eye,CNOT2_01)
	CNOT3_21=np.kron(eye,CNOT2_10)
	CNOT3_02=np.matrix('1 0 0 0 0 0 0 0; 0 1 0 0 0 0 0 0; 0 0 1 0 0 0 0 0; 0 0 0 1 0 0 0 0; 0 0 0 0 0 1 0 0; 0 0 0 0 1 0 0 0; 0 0 0 0 0 0 0 1; 0 0 0 0 0 0 1 0')
	CNOT3_20=np.matrix('1 0 0 0 0 0 0 0; 0 0 0 0 0 1 0 0; 0 0 1 0 0 0 0 0; 0 0 0 0 0 0 0 1; 0 0 0 0 1 0 0 0; 0 1 0 0 0 0 0 0; 0 0 0 0 0 0 1 0; 0 0 0 1 0 0 0 0')

	# operates on 2 out of 4 entangled qubits, control is first subscript, target second
	CNOT4_01=np.kron(CNOT3_01,eye)
	CNOT4_10=np.kron(CNOT3_10,eye)
	CNOT4_12=np.kron(CNOT3_12,eye)
	CNOT4_21=np.kron(CNOT3_21,eye)
	CNOT4_13=np.kron(eye,CNOT3_02)
	CNOT4_31=np.kron(eye,CNOT3_20)
	CNOT4_02=np.kron(CNOT3_02,eye)
	CNOT4_20=np.kron(CNOT3_20,eye)
	CNOT4_23=np.kron(eye,CNOT3_12)
	CNOT4_32=np.kron(eye,CNOT3_21)
	CNOT4_03=np.eye(16,16)
	CNOT4_03[np.array([8,9])]=CNOT4_03[np.array([9,8])]
	CNOT4_03[np.array([10,11])]=CNOT4_03[np.array([11,10])]
	CNOT4_03[np.array([12,13])]=CNOT4_03[np.array([13,12])]
	CNOT4_03[np.array([14,15])]=CNOT4_03[np.array([15,14])]
	CNOT4_30=np.eye(16,16)
	CNOT4_30[np.array([1,9])]=CNOT4_30[np.array([9,1])]
	CNOT4_30[np.array([3,11])]=CNOT4_30[np.array([11,3])]
	CNOT4_30[np.array([5,13])]=CNOT4_30[np.array([13,5])]
	CNOT4_30[np.array([7,15])]=CNOT4_30[np.array([15,7])]

	# operates on 2 out of 5 entangled qubits, control is first subscript, target second
	CNOT5_01=np.kron(CNOT4_01,eye)
	CNOT5_10=np.kron(CNOT4_10,eye)
	CNOT5_02=np.kron(CNOT4_02,eye)
	CNOT5_20=np.kron(CNOT4_20,eye)
	CNOT5_03=np.kron(CNOT4_03,eye)
	CNOT5_30=np.kron(CNOT4_30,eye)
	CNOT5_12=np.kron(CNOT4_12,eye)
	CNOT5_21=np.kron(CNOT4_21,eye)
	CNOT5_13=np.kron(CNOT4_13,eye)
	CNOT5_31=np.kron(CNOT4_31,eye)
	CNOT5_14=np.kron(eye,CNOT4_03)
	CNOT5_41=np.kron(eye,CNOT4_30)
	CNOT5_23=np.kron(CNOT4_23,eye)
	CNOT5_32=np.kron(CNOT4_32,eye)
	CNOT5_24=np.kron(eye,CNOT4_13)
	CNOT5_42=np.kron(eye,CNOT4_31)
	CNOT5_34=np.kron(eye,CNOT4_23)
	CNOT5_43=np.kron(eye,CNOT4_32)
	CNOT5_04=np.eye(32,32)
	CNOT5_04[np.array([16,17])]=CNOT5_04[np.array([17,16])]
	CNOT5_04[np.array([18,19])]=CNOT5_04[np.array([19,18])]
	CNOT5_04[np.array([20,21])]=CNOT5_04[np.array([21,20])]
	CNOT5_04[np.array([22,23])]=CNOT5_04[np.array([23,22])]
	CNOT5_04[np.array([24,25])]=CNOT5_04[np.array([25,24])]
	CNOT5_04[np.array([26,27])]=CNOT5_04[np.array([27,26])]
	CNOT5_04[np.array([28,29])]=CNOT5_04[np.array([29,28])]
	CNOT5_04[np.array([30,31])]=CNOT5_04[np.array([31,30])]
	CNOT5_40=np.eye(32,32)
	CNOT5_40[np.array([1,17])]=CNOT5_40[np.array([17,1])]
	CNOT5_40[np.array([3,19])]=CNOT5_40[np.array([19,3])]
	CNOT5_40[np.array([5,21])]=CNOT5_40[np.array([21,5])]
	CNOT5_40[np.array([7,23])]=CNOT5_40[np.array([23,7])]
	CNOT5_40[np.array([9,25])]=CNOT5_40[np.array([25,9])]
	CNOT5_40[np.array([11,27])]=CNOT5_40[np.array([27,11])]
	CNOT5_40[np.array([13,29])]=CNOT5_40[np.array([29,13])]
	CNOT5_40[np.array([15,31])]=CNOT5_40[np.array([31,15])]

####
## States
####
class State(object):
	i_=np.complex(0,1)
	## One qubit states (basis)
	# standard basis (z)
	zero_state=np.matrix('1; 0')
	one_state=np.matrix('0; 1')
	# diagonal basis (x)
	plus_state=1/sqrt(2)*np.matrix('1; 1')
	minus_state=1/sqrt(2)*np.matrix('1; -1')
	# circular basis (y)
	plusi_state=1/sqrt(2)*np.matrix([[1],[i_]])    # also known as clockwise arrow state
	minusi_state=1/sqrt(2)*np.matrix([[1],[-i_]])  # also known as counterclockwise arrow state

	# 2-qubit states
	bell_state=1/sqrt(2)*np.matrix('1; 0; 0; 1')
	@staticmethod
	def change_to_x_basis(state):
		return Gate.H*state

	@staticmethod
	def change_to_y_basis(state):
		return Gate.H*Gate.Sdagger*state

	@staticmethod
	def change_to_w_basis(state):
		# W=1/sqrt(2)*(X+Z)
		return Gate.H*Gate.T*Gate.H*Gate.S*state

	@staticmethod
	def change_to_v_basis(state):
		# V=1/sqrt(2)*(-X+Z)
		return Gate.H*Gate.Tdagger*Gate.H*Gate.S*state

	@staticmethod 
	def is_fully_separable(qubit_state):
		try:
			separated_state=State.separate_state(qubit_state)
			for state in separated_state:
				State.string_from_state(state)
			return True
		except StateNotSeparableException, e:
			return False

	@staticmethod
	def get_first_qubit(qubit_state):
		return State.separate_state(qubit_state)[0]

	@staticmethod
	def get_second_qubit(qubit_state):
		return State.separate_state(qubit_state)[1]

	@staticmethod
	def get_third_qubit(qubit_state):
		return State.separate_state(qubit_state)[2]

	@staticmethod
	def get_fourth_qubit(qubit_state):
		return State.separate_state(qubit_state)[3]

	@staticmethod
	def get_fifth_qubit(qubit_state):
		return State.separate_state(qubit_state)[4]

	@staticmethod 
	def all_state_strings(n_qubits):
		return [''.join(map(str,state_desc)) for state_desc in itertools.product([0, 1], repeat=n_qubits)]

	@staticmethod
	def state_from_string(qubit_state_string):
		if not all(x in '01' for x in qubit_state_string):
			raise Exception("Description must be a string in binary")
		state=None
		for qubit in qubit_state_string:
			if qubit=='0':
				new_contrib=State.zero_state
			elif qubit=='1':
				new_contrib=State.one_state
			if state==None:
				state=new_contrib
			else:
				state=np.kron(state,new_contrib)
		return state

	@staticmethod
	def string_from_state(qubit_state):
		separated=State.separate_state(qubit_state)
		desc=''
		for state in separated:
			if np.allclose(state,State.zero_state):
				desc+='0'
			elif np.allclose(state,State.one_state):
				desc+='1'
			else: 
				raise StateNotSeparableException("State is not separable")
		return desc

	@staticmethod
	def separate_state(qubit_state):
		"""This only works if the state is fully separable at present

		Throws exception if not a separable state"""
		n_entangled=QuantumRegister.num_qubits(qubit_state)
		if list(qubit_state.flat).count(1)==1:
			separated_state=[]
			idx_state=list(qubit_state.flat).index(1)
			add_factor=0
			size=qubit_state.shape[0]
			while(len(separated_state)<n_entangled):
				size=size/2
				if idx_state<(add_factor+size):
					separated_state+=[State.zero_state]
					add_factor+=0
				else:
					separated_state+=[State.one_state]
					add_factor+=size
			return separated_state
		else:
			# Try a few naive separations before giving up
			cardinal_states=[State.zero_state,State.one_state,State.plus_state,State.minus_state,State.plusi_state,State.minusi_state]
			for separated_state in itertools.product(cardinal_states, repeat=n_entangled):
				candidate_state=reduce(lambda x,y:np.kron(x,y),separated_state)
				if np.allclose(candidate_state,qubit_state):
					return separated_state
			# TODO: more general separation methods
			raise StateNotSeparableException("TODO: Entangled qubits not represented yet in quantum computer implementation. Can currently do manual calculations; see TestBellState for Examples")

	@staticmethod
	def measure(state):
		"""finally some probabilities, whee. To properly use, set the qubit you measure to the result of this function
			to collapse it. state=measure(state). Currently supports only up to three entangled qubits """
		state_z=state
		n_qubits=QuantumRegister.num_qubits(state)
		probs=Probability.get_probabilities(state_z)
		rand=random.random()
		for idx,state_desc in enumerate(State.all_state_strings(n_qubits)):
			if rand < sum(probs[0:(idx+1)]):
				return State.state_from_string(state_desc)

	@staticmethod
	def get_bloch(state):
		return np.array((Probability.expectation_x(state),Probability.expectation_y(state),Probability.expectation_z(state)))

	@staticmethod
	def pretty_print_gate_action(gate,n_qubits):
		for s in list(itertools.product([0,1], repeat=n_qubits)):
			sname=('%d'*n_qubits)%s
			state=State.state_from_string(sname)
			print sname,'->',State.string_from_state(gate*state)

class StateNotSeparableException(exceptions.Exception):
	def __init__(self,args=None):
		self.args=args

class Probability(object):
	@staticmethod
	def get_probability(coeff):
		return (coeff*coeff.conjugate()).real

	@staticmethod
	def get_probabilities(state):
		return [Probability.get_probability(x) for x in state.flat]

	@staticmethod
	def get_correlated_expectation(state):
		probs=Probability.get_probabilities(state)
		return probs[0]+probs[3]-probs[1]-probs[2]

	@staticmethod
	def pretty_print_probabilities(state):
		probs=Probability.get_probabilities(state)
		am_desc='|psi>='
		pr_desc=''
		for am,pr,state_desc in zip(state.flat,probs,State.all_state_strings(QuantumRegister.num_qubits(state))):
			if am!=0:
				if am!=1:
					am_desc+='%r|%s>+'%(am,state_desc)
				else:
					am_desc+='|%s>+'%(state_desc)
			if pr!=0:
				pr_desc+='Pr(|%s>)=%f; '%(state_desc,pr)
		print am_desc[0:-1]
		print pr_desc
		if state.shape==(4,1):
			print "<state>=%f" % float(probs[0]+probs[3]-probs[1]-probs[2])

	@staticmethod
	def expectation_x(state):
		state_x=State.change_to_x_basis(state)
		prob_zero_state=(state_x.item(0)*state_x.item(0).conjugate()).real
		prob_one_state=(state_x.item(1)*state_x.item(1).conjugate()).real
		return prob_zero_state-prob_one_state	

	@staticmethod
	def expectation_y(state):
		state_y=State.change_to_y_basis(state)
		prob_zero_state=(state_y.item(0)*state_y.item(0).conjugate()).real
		prob_one_state=(state_y.item(1)*state_y.item(1).conjugate()).real
		return prob_zero_state-prob_one_state

	@staticmethod
	def expectation_z(state):
		state_z=state
		prob_zero_state=(state_z.item(0)*state_z.item(0).conjugate()).real
		prob_one_state=(state_z.item(1)*state_z.item(1).conjugate()).real
		return prob_zero_state-prob_one_state

class QuantumRegister(object):
	def __init__(self,name,state=State.zero_state,entangled=None):
		self._entangled=[self]
		self._state=state
		self.name = name
		self.idx=None
		self._noop = [] # after a measurement set this so that we can allow no further operations. Set to Bloch coords if bloch operation performed
	@staticmethod
	def num_qubits(state):	
		num_qubits=log(state.shape[0],2)
		if state.shape[1]!=1 or num_qubits not in [1,2,3,4,5]:
			raise Exception("unrecognized state shape")
		else:
			return int(num_qubits)

	def get_entangled(self):
		return self._entangled
	def set_entangled(self,entangled):
		self._entangled=entangled
		for qb in self._entangled:
			qb._state=self._state
			qb._entangled=self._entangled
	def get_state(self):
		return self._state
	def set_state(self,state):
		self._state=state
		for qb in self._entangled:
			qb._state=state
			qb._entangled=self._entangled
			qb._noop=self._noop

	def get_noop(self):
		return self._noop

	def set_noop(self,noop):
		self._noop=noop
		for qb in self._entangled:
			qb._noop=noop

	def is_entangled(self):
		return len(self._entangled)>1
	def is_entangled_with(self,qubit):
		return qubit in self._entangled

	def get_indices(self,target_qubit):
		if not self.is_entangled_with(target_qubit):
			search=self._entangled+target_qubit.get_entangled()
		else:
			search=self._entangled
		return search.index(self),search.index(target_qubit)
	def get_num_qubits(self):
		return QuantumRegister.num_qubits(self._state)
	def __eq__(self,other):
		return self.name==other.name and np.allclose(self._noop,other._noop) and np.allclose(self.get_state(),other.get_state()) and QuantumRegisterCollection.orderings_equal(self._entangled,other._entangled)

class QuantumRegisterCollection(object):
	def __init__(self,qubits):
		self._qubits=qubits
		for idx,qb in enumerate(self._qubits):
			qb.idx = idx
		self.num_qubits=len(qubits)

	def get_quantum_register_containing(self,name):
		for qb in self._qubits:
			if qb.name == name:
				return qb
			else:
				for entqb in qb.get_entangled():
					if entqb.name==name:
						return entqb
		raise Exception("qubit %s not found" % name)

	def get_quantum_registers(self):
		return self._qubits

	def entangle_quantum_registers(self,first_qubit,second_qubit):
		new_entangle=first_qubit.get_entangled()+second_qubit.get_entangled()
		if len(first_qubit.get_entangled()) >= len(second_qubit.get_entangled()):
			self._remove_quantum_register_named(second_qubit.name)
			first_qubit.set_entangled(new_entangle)
		else:
			self._remove_quantum_register_named(first_qubit.name)
			second_qubit.set_entangled(new_entangle)
	def _remove_quantum_register_named(self,name):
		self._qubits=filter(lambda qb: qb.name!=name,self._qubits)

	def is_in_canonical_ordering(self):
		return self.get_qubit_order()==range(self.num_qubits)
	@staticmethod
	def is_in_increasing_order(qb_list):
		for a,b in zip(qb_list,qb_list[1:]):
			if not a.idx<b.idx:
				return False
		return True

	def get_entangled_qubit_order(self):
		ordering=[]
		for qb in self._qubits:
			ent_order=[]
			for ent in qb.get_entangled():
				ent_order+=[ent]
			ordering+=[ent_order]
		return ordering

	def get_qubit_order(self):
		ordering=[]
		for qb in self._qubits:
			for ent in qb.get_entangled():
				ordering+=[ent.idx]
		return ordering

	def add_quantum_register(self,qubit):
		qubit.idx=self.num_qubits
		self._qubits+=[qubit]
		self.num_qubits+=1

	@staticmethod 
	def orderings_equal(order_one,order_two):
		return [qb.idx for qb in order_one] == [qb.idx for qb in order_two]

class QuantumComputer(object):
	"""This class is meant to simulate the 5-qubit IBM quantum computer, 
		and be able to interpret the auto generated programs on the site.

		For entangled states, qubits are always reported in alphanumerical order
		"""
	def __init__(self):
		self.qubits=QuantumRegisterCollection([QuantumRegister("q0"),QuantumRegister("q1"),QuantumRegister("q2"),QuantumRegister("q3"),QuantumRegister("q4")])
	def reset(self):
		self.qubits=QuantumRegisterCollection([QuantumRegister("q0"),QuantumRegister("q1"),QuantumRegister("q2"),QuantumRegister("q3"),QuantumRegister("q4")])
	def get_ordering(self):
		return self.qubits.get_qubit_order()
	def is_in_canonical_ordering(self):
		return self.qubits.is_in_canonical_ordering()

	def get_requested_state_order(self,name):
		get_states_for=[self.qubits.get_quantum_register_containing(x.strip()) for x in name.split(',')]
		if not QuantumRegisterCollection.is_in_increasing_order(get_states_for):
			raise Exception("at this time, requested qubits must be in increasing order")
		entangled_qubit_order=self.qubits.get_entangled_qubit_order()
		# # We know the idxs run range(5)
		# # We know if the idxs are contiguous, increasing we are good
		for get_state_for_qb in get_states_for:
			for eqb in entangled_qubit_order:
				eqo=[q.idx for q in eqb]
				# We know if the idxs are missing a number AND we want to find an idx that lies in there, we must entangle those states
				if not get_state_for_qb.idx in eqo and get_state_for_qb.idx in range(min(eqo),max(eqo)+1):
					print "We'll have to entangle the two"
					# We'll have to entangle the two
					qb1=self.qubits.get_quantum_register_containing(eqo[0].name)
					get_state_for_qb.set_state(np.kron(qb.get_state(),qb1.get_state()))
					self.qubits.entangle_quantum_registers(get_state_for_qb,qb1)
					return self.qubit_states_equal(name,state)

		# OK, if we reach here, we have all the entanglement we need, and we just need to sort the individual entangled states to match the output order
		for qubit in self.qubits.get_quantum_registers():
			if not QuantumRegisterCollection.is_in_increasing_order(qubit.get_entangled()): # all one apart
				# We're not in order
				# We need to assert that the full return can be comprised of concatenating states from beginning to end without extras
				if not set(qubit.get_entangled())<=set(get_states_for) and set(qubit.get_entangled()).intersection(set(get_states_for)):
					raise Exception("With this entanglement setup we can't fully separate out just the qubits of iterest. Try measuring more bits")
				# We only care if we actually want to return something from this state Put eqo in order then
				# We want a sorting algorithm that easily maps to matrix operations, since we only have 5 elements max
				# we'll use bubble sort
				swapped=True
				n=len(qubit.get_entangled())
				while(swapped):
					swapped=False
					current_entangled=qubit.get_entangled()

					for idx in range(len(current_entangled)-1):
						first_qubit=current_entangled[idx]
						second_qubit=current_entangled[idx+1]
						if first_qubit.idx > second_qubit.idx:
							current_entangled[idx]=second_qubit
							current_entangled[idx+1]=first_qubit
							permute=np.eye(2**n,2**n)
							all_combos=list(itertools.product([0,1],repeat=n))
							already_swapped=[]
							for icombo,combo in enumerate(all_combos[:len(all_combos)]):
								new_combo=list(combo)
								new_combo[idx]=combo[idx+1]
								new_combo[idx+1]=combo[idx]
								new_combo=tuple(new_combo)
								if combo!=new_combo:
									inew_combo=all_combos.index(new_combo)
									swapset=set([icombo,inew_combo])
									if not swapset in already_swapped:
										already_swapped+=[swapset]
										permute[np.array([icombo,inew_combo])]=permute[np.array([inew_combo,icombo])]
							first_qubit.set_entangled(current_entangled)
							first_qubit.set_state(permute*first_qubit.get_state())
							swapped=True
		# OK, if we reach here, everything is in order, and entangled states are either all of interest or none are of interest we just need to return it!
		answer_state=None
		for qb in self.qubits.get_quantum_registers():
			if set(qb.get_entangled()) <= set(get_states_for):
				if answer_state==None:
					answer_state=qb.get_state()
				else:
					answer_state=np.kron(answer_state,qb.get_state())
		return answer_state

	def probabilities_equal(self,name,prob):
		get_states_for=[self.qubits.get_quantum_register_containing(x.strip()) for x in name.split(',')]
		if not QuantumRegisterCollection.is_in_increasing_order(get_states_for):
			raise Exception("at this time, requested qubits must be in increasing order")
		entangled_qubit_order=self.qubits.get_entangled_qubit_order()
		if (len(get_states_for)==1 and self.is_in_canonical_ordering()) or (get_states_for in entangled_qubit_order):
			return np.allclose(Probability.get_probabilities(get_states_for[0].get_state()),prob)
		else:
			answer_state=self.get_requested_state_order(name)
			return np.allclose(Probability.get_probabilities(answer_state),prob,atol=1e-2)			

	def qubit_states_equal(self,name,state):
		get_states_for=[self.qubits.get_quantum_register_containing(x.strip()) for x in name.split(',')]
		if not QuantumRegisterCollection.is_in_increasing_order(get_states_for):
			raise Exception("at this time, requested qubits must be in increasing order")
		entangled_qubit_order=self.qubits.get_entangled_qubit_order()
		if (len(get_states_for)==1 and self.is_in_canonical_ordering()) or (get_states_for in entangled_qubit_order):
			return np.allclose(get_states_for[0].get_state(),state)
		else:
			answer_state=self.get_requested_state_order(name)
			return np.allclose(answer_state,state)			

	def bloch_coords_equal(self,name,coords):
		on_qubit=self.qubits.get_quantum_register_containing(name)
		if self.is_in_canonical_ordering() and not on_qubit.is_entangled():
			return np.allclose(on_qubit.get_noop(),coords,atol=1e-3)
		else:
			try:
				separated_qubit=State.separate_state(on_qubit.get_state())
				on_qubit_idx=(on_qubit.get_entangled()).index(on_qubit)
				return np.allclose(State.get_bloch(separated_qubit[on_qubit_idx]),coords,atol=1e-3)
			except StateNotSeparableException, e:
				raise Exception("Entangled measurements that cannot be separatednot yet implemented for bloch sphere")

	def apply_gate(self,gate,on_qubit_name):
		on_qubit=self.qubits.get_quantum_register_containing(on_qubit_name)
		if len(on_qubit.get_noop()) > 0:
			print "NOTE this qubit has been measured previously, there should be no more gates allowed but we are reverting that measurement for consistency with IBM's language"
			on_qubit.set_state(on_qubit.get_noop())
			on_qubit.set_noop([])
		if not on_qubit.is_entangled():
			if on_qubit.get_num_qubits()!=1:
				raise Exception("This qubit is not marked as entangled but it has an entangled state")
			on_qubit.set_state(gate*on_qubit.get_state())
		else:
			if not on_qubit.get_num_qubits()>1:
				raise Exception("This qubit is marked as entangled but it does not have an entangled state")
			n_entangled=len(on_qubit.get_entangled())
			apply_gate_to_qubit_idx=[qb.name for qb in on_qubit.get_entangled()].index(on_qubit_name)
			if apply_gate_to_qubit_idx==0:
				entangled_gate=gate
			else:
				entangled_gate=Gate.eye
			for i in range(1,n_entangled):
				if apply_gate_to_qubit_idx==i:
					entangled_gate=np.kron(entangled_gate,gate)
				else:
					entangled_gate=np.kron(entangled_gate,Gate.eye)
			on_qubit.set_state(entangled_gate*on_qubit.get_state())

	def apply_two_qubit_gate_CNOT(self,first_qubit_name,second_qubit_name):
		""" Should work for all combination of qubits"""
		first_qubit=self.qubits.get_quantum_register_containing(first_qubit_name)
		second_qubit=self.qubits.get_quantum_register_containing(second_qubit_name)
		if len(first_qubit.get_noop())>0 or len(second_qubit.get_noop())>0:
			raise Exception("Control or target qubit has been measured previously, no more gates allowed")
		if not first_qubit.is_entangled() and not second_qubit.is_entangled():
			combined_state=np.kron(first_qubit.get_state(),second_qubit.get_state())
			if first_qubit.get_num_qubits()!=1 or second_qubit.get_num_qubits()!=1:
				raise Exception("Both qubits are marked as not entangled but one or the other has an entangled state")
			new_state=Gate.CNOT2_01*combined_state
			if State.is_fully_separable(new_state):
				second_qubit.set_state(State.get_second_qubit(new_state))
			else:
				self.qubits.entangle_quantum_registers(first_qubit,second_qubit)
				first_qubit.set_state(new_state)
		else:
			if not first_qubit.is_entangled_with(second_qubit):
				# Entangle the state
				combined_state=np.kron(first_qubit.get_state(),second_qubit.get_state())
				self.qubits.entangle_quantum_registers(first_qubit,second_qubit)
			else:
				# We are ready to do the operation
				combined_state=first_qubit.get_state()
			# Time for more meta programming!
			# Select gate based on indices
			control_qubit_idx,target_qubit_idx=first_qubit.get_indices(second_qubit)
			gate_size=QuantumRegister.num_qubits(combined_state)
			try:
				exec 'gate=Gate.CNOT%d_%d%d' %(gate_size,control_qubit_idx,target_qubit_idx) 
			except:
				print 'gate=Gate.CNOT%d_%d%d' %(gate_size,control_qubit_idx,target_qubit_idx)
				raise Exception("Unrecognized combination of number of qubits")
			first_qubit.set_state(gate*combined_state)

				


	def bloch(self,qubit_name):
		on_qubit=self.qubits.get_quantum_register_containing(qubit_name)
		if len(on_qubit.get_noop())==0:
			if not on_qubit.is_entangled():
				on_qubit.set_noop(State.get_bloch(on_qubit.get_state()))
			else:
				on_qubit.set_noop([1])

	def measure(self,qubit_name):
		on_qubit=self.qubits.get_quantum_register_containing(qubit_name)
		if len(on_qubit.get_noop())==0:
			on_qubit.set_noop(on_qubit.get_state()) # state before measurement for testing
			on_qubit.set_state(State.measure(on_qubit.get_state()))

	def execute(self,program):
		"""Time for some very lazy meta programming!
		"""
		# Transforming IBM's language to my variables
		lines=program.split(';')
		translation=[
			['q[0]','"q0"'],
			['q[1]','"q1"'],
			['q[2]','"q2"'],
			['q[3]','"q3"'],
			['q[4]','"q4"'],
			['bloch ',r'self.bloch('],
			['measure ',r'self.measure('],
			['id ','self.apply_gate(Gate.eye,'],
			['sdg ','self.apply_gate(Gate.Sdagger,'],
			['tdg ','self.apply_gate(Gate.Tdagger,'],
			['h ','self.apply_gate(Gate.H,'],
			['t ','self.apply_gate(Gate.T,'],
			['s ','self.apply_gate(Gate.S,'],
			['x ','self.apply_gate(Gate.X,'],
			['y ','self.apply_gate(Gate.Y,'],
			['z ','self.apply_gate(Gate.Z,'],
			]
		cnot_re=re.compile('^cx (q\[[0-4]\]), (q\[[0-4]\])$')
		for l in lines:
			l=l.strip()
			if not l: continue
			# CNOT operates on two qubits so gets special processing
			cnot=cnot_re.match(l)
			if cnot:
				control_qubit=cnot.group(1)
				target_qubit=cnot.group(2)
				l='self.apply_two_qubit_gate_CNOT(%s,%s'%(control_qubit,target_qubit)
			for k,v in translation:
				l=l.replace(k,v)
			l=l+')'
			# Now running the code
			exec l


class Program(object):
	def __init__(self,code,result_probability=[],bloch_vals=()):
		self.code=code
		self.result_probability=result_probability
		self.bloch_vals=bloch_vals
class Programs(object):
	"""Some useful programs collected in one place for running on the quantum computer class"""
	program_blue_state=Program("""h q[1];
			t q[1];
			h q[1];
			t q[1];
			h q[1];
			t q[1];
			s q[1];
			h q[1];
			t q[1];
			h q[1];
			t q[1];
			s q[1];
			h q[1];
			bloch q[1];""")

	program_test_XYZMeasureIdSdagTdag=Program("""sdg q[0];
			x q[1];
			x q[2];
			id q[3];
			z q[4];
			tdg q[0];
			y q[4];
			measure q[0];
			measure q[1];
			measure q[2];
			measure q[3];
			measure q[4];""")

	program_test_cnot=Program("""x q[1];
			cx q[1], q[2];""")

	program_test_many=Program("""sdg q[0];
			x q[1];
			x q[2];
			id q[3];
			z q[4];
			tdg q[0];
			cx q[1], q[2];
			y q[4];
			measure q[0];
			measure q[1];
			measure q[2];
			measure q[3];
			measure q[4];""")
	# IBM Tutorial Section III, Page 4
	program_zz=Program("""h q[1];
		cx q[1], q[2];
		measure q[1];
		measure q[2];""") # "00",0.5; "11",0.5 # <zz> = 2

	program_zw=Program("""h q[1];
		cx q[1], q[2];
		s q[2];
		h q[2];
		t q[2];
		h q[2];
		measure q[1];
		measure q[2]""") # "00",0.426777; "01",0.073223; "10",0.073223; "11",0.426777 # <zw> = 1/sqrt(2)

	program_zv=Program("""h q[1];
		cx q[1], q[2];
		s q[2];
		h q[2];
		tdg q[2];
		h q[2];
		measure q[1];
		measure q[2];""") #"00",0.426777; "01",0.073223; "10",0.073223; "11",0.426777 # <zv> = 1/sqrt(2)

	program_xw=Program("""h q[1];
		cx q[1], q[2];
		h q[1];
		s q[2];
		h q[2];
		t q[2];
		h q[2];
		measure q[1];
		measure q[2];""") # "00",0.426777; "01",0.073223; "10",0.073223; "11",0.426777 # <xw> = 

	program_xv=Program("""h q[1];
		cx q[1], q[2];
		h q[1];
		s q[2];
		h q[2];
		tdg q[2];
		h q[2];
		measure q[1];
		measure q[2];""") #"00",0.073223; "01",0.426777; "10",0.426777; "11",0.073223; # <xv> =

	# Currently not used, but creats a superposition of 00 and 01
	program_00_01_super=Program("""sdg q[1];
		t q[1];
		t q[1];
		s q[1];
		h q[1];
		h q[0];
		h q[1];
		h q[0];
		h q[1];
		cx q[0], q[1];
		measure q[0];
		measure q[1];""")
	# IBM Tutorial Section III, Page 5
	program_ghz=Program("""h q[0];
		h q[1];
		x q[2];
		cx q[1], q[2];
		cx q[0], q[2];
		h q[0];
		h q[1];
		h q[2];
		measure q[0];
		measure q[1];
		measure q[2];""",result_probability=[0.5,0,0,0,0,0,0,0.5])# "000":0.5; "111":0.5

	program_ghz_measure_yyx=Program("""h q[0];
		h q[1];
		x q[2];
		cx q[1], q[2];
		cx q[0], q[2];
		h q[0];
		h q[1];
		h q[2];
		sdg q[0];
		sdg q[1];
		h q[2];
		h q[0];
		h q[1];
		measure q[2];
		measure q[0];
		measure q[1];""",result_probability=[0.25,0,0,0.25,0,0.25,0.25,0]) # "000":0.25; "011": 0.25; "101": 0.25; "110":0.25

	program_ghz_measure_yxy=Program("""h q[0];
		h q[1];
		x q[2];
		cx q[1], q[2];
		cx q[0], q[2];
		h q[0];
		h q[1];
		h q[2];
		sdg q[0];
		h q[1];
		sdg q[2];
		h q[0];
		measure q[1];
		h q[2];
		measure q[0];
		measure q[2];""",result_probability=[0.25,0,0,0.25,0,0.25,0.25,0]) # "000":0.25; "011": 0.25; "101": 0.25; "110":0.25

	program_ghz_measure_xyy=Program("""h q[0];
		h q[1];
		x q[2];
		cx q[1], q[2];
		cx q[0], q[2];
		h q[0];
		h q[1];
		h q[2];
		h q[0];
		sdg q[1];
		sdg q[2];
		measure q[0];
		h q[1];
		h q[2];
		measure q[1];
		measure q[2];""",result_probability=[0.25,0,0,0.25,0,0.25,0.25,0]) # "000":0.25; "011": 0.25; "101": 0.25; "110":0.25


	program_ghz_measure_xxx=Program("""h q[0];
		h q[1];
		x q[2];
		cx q[1], q[2];
		cx q[0], q[2];
		h q[0];
		h q[1];
		h q[2];
		h q[0];
		h q[1];
		h q[2];
		measure q[0];
		measure q[1];
		measure q[2];""",result_probability=[0,0.25,0.25,0,0.25,0,0,0.25]) #"001":0.25; "010": 0.25; "100": 0.25; "111":0.25

	# IBM Tutorial Section IV, Page 1
	program_reverse_cnot=Program("""x q[2];
		h q[1];
		h q[2];
		cx q[1], q[2];
		h q[1];
		h q[2];
		measure q[1];
		measure q[2];""",result_probability=(0.0,0.0,0.0,1.0))# "11": 1.0

	program_swap=Program("""x q[2];
		cx q[1], q[2];
		h q[1];
		h q[2];
		cx q[1], q[2];
		h q[1];
		h q[2];
		cx q[1], q[2];
		measure q[1];
		measure q[2];""",result_probability=(0.0,0.0,1.0,0.0)) # "10": 1.0

	program_swap_q0_q1=Program("""h q[0];
		cx q[0], q[2];
		h q[0];
		h q[2];
		cx q[0], q[2];
		h q[0];
		h q[2];
		cx q[0], q[2];
		cx q[1], q[2];
		h q[1];
		h q[2];
		cx q[1], q[2];
		h q[1];
		h q[2];
		cx q[1], q[2];
		cx q[0], q[2];
		h q[0];
		h q[2];
		cx q[0], q[2];
		h q[0];
		h q[2];
		cx q[0], q[2];
		bloch q[0];
		bloch q[1];
		bloch q[2];""",bloch_vals=((0,0,1),(1,0,0),(0,0,1),None,None)) # Bloch q0: (0,0,1); #q1: (1,0,0) q2: (0,0,1)
	program_controlled_hadamard=Program("""h q[1];
		s q[1];
		h q[2];
		sdg q[2];
		cx q[1], q[2];
		h q[2];
		t q[2];
		cx q[1], q[2];
		t q[2];
		h q[2];
		s q[2];
		x q[2];
		measure q[1];
		measure q[2];""",result_probability=[0.5,0.0,0.25,0.25]) # "00": 0.5; "10": 0.25; "11":0.25
	program_approximate_sqrtT=Program("""h q[0];
		h q[1];
		h q[2];
		h q[3];
		h q[4];
		bloch q[0];
		h q[1];
		t q[2];
		s q[3];
		z q[4];
		t q[1];
		bloch q[2];
		bloch q[3];
		bloch q[4];
		h q[1];
		t q[1];
		h q[1];
		t q[1];
		s q[1];
		h q[1];
		t q[1];
		h q[1];
		t q[1];
		s q[1];
		h q[1];
		t q[1];
		h q[1];
		t q[1];
		h q[1];
		bloch q[1];""",bloch_vals=((1,0,0),(0.927, 0.375, 0.021), (0.707, 0.707, 0.000),(0.000, 1.000, 0.000), (-1.000, 0.000, 0.000))) #Bloch coords q0: (1.000, 0.000, 0.000) q1: (0.927, 0.375, 0.021) q2: (0.707, 0.707, 0.000) q3: (0.000, 1.000, 0.000) q4: (-1.000, 0.000, 0.000) # checks out when we manually get_bloch
	program_toffoli_state=Program("""h q[0];
		h q[1];
		h q[2];
		cx q[1], q[2];
		tdg q[2];
		cx q[0], q[2];
		t q[2];
		cx q[1], q[2];
		tdg q[2];
		cx q[0], q[2];
		t q[1];
		t q[2];
		cx q[1], q[2];
		h q[1];
		h q[2];
		cx q[1], q[2];
		h q[1];
		h q[2];
		cx q[1], q[2];
		cx q[0], q[2];
		t q[0];
		h q[1];
		tdg q[2];
		cx q[0], q[2];
		measure q[0];
		measure q[1];
		measure q[2];""",result_probability=(0.25,0.25,0,0,0.25,0,0,0.25)) #000, 001, 100, 111 all 0.25
	program_toffoli_with_flips=Program("""x q[0];
		x q[1];
		id q[2];
		h q[2];
		cx q[1], q[2];
		tdg q[2];
		cx q[0], q[2];
		t q[2];
		cx q[1], q[2];
		tdg q[2];
		cx q[0], q[2];
		t q[1];
		t q[2];
		h q[2];
		cx q[1], q[2];
		h q[1];
		h q[2];
		cx q[1], q[2];
		h q[1];
		h q[2];
		cx q[1], q[2];
		cx q[0], q[2];
		t q[0];
		tdg q[2];
		cx q[0], q[2];
		measure q[0];
		measure q[1];
		measure q[2];""",result_probability=(0,0,0,0,0,0,0,1.0)) #111: 1.0
	all_multi_gate_tests=[program_reverse_cnot,program_swap,program_swap_q0_q1,program_controlled_hadamard,program_approximate_sqrtT,program_toffoli_state,program_toffoli_with_flips]
	# IBM Section IV, page 3 Grover's algorithm
	program_grover_n2_a00=Program("""h q[1];
		h q[2];
		s q[1];
		s q[2];
		h q[2];
		cx q[1], q[2];
		h q[2];
		s q[1];
		s q[2];
		h q[1];
		h q[2];
		x q[1];
		x q[2];
		h q[2];
		cx q[1], q[2];
		h q[2];
		x q[1];
		x q[2];
		h q[1];
		h q[2];
		measure q[1];
		measure q[2];""",result_probability=(1.0,0,0,0)) # 00: 1.0
	program_grover_n2_a01=Program("""h q[1];
		h q[2];
		s q[2];
		h q[2];
		cx q[1], q[2];
		h q[2];
		s q[2];
		h q[1];
		h q[2];
		x q[1];
		x q[2];
		h q[2];
		cx q[1], q[2];
		h q[2];
		x q[1];
		x q[2];
		h q[1];
		h q[2];
		measure q[1];
		measure q[2];""",result_probability=(0.0,1.0,0.0,0.0)) # 01: 1.0
 	program_grover_n2_a10=Program("""h q[1];
		h q[2];
		s q[1];
		h q[2];
		cx q[1], q[2];
		h q[2];
		s q[1];
		h q[1];
		h q[2];
		x q[1];
		x q[2];
		h q[2];
		cx q[1], q[2];
		h q[2];
		x q[1];
		x q[2];
		h q[1];
		h q[2];
		measure q[1];
		measure q[2];""",result_probability=(0,0,1.0,0)) # 10: 1.0
	program_grover_n2_a11=Program("""h q[1];
		h q[2];
		h q[2];
		cx q[1], q[2];
		h q[2];
		h q[1];
		h q[2];
		x q[1];
		x q[2];
		h q[2];
		cx q[1], q[2];
		h q[2];
		x q[1];
		x q[2];
		h q[1];
		h q[2];
		measure q[1];
		measure q[2];""",result_probability=(0,0,0,1.0)) # 10: 1.0
	all_grover_tests=[program_grover_n2_a00,program_grover_n2_a01,program_grover_n2_a10,program_grover_n2_a11]
	 # IBM Section IV, page 4 Deutsch-Jozsa Algorithm
	program_deutschjozsa_n3=Program("""h q[0];
		h q[1];
		h q[2];
		h q[2];
		z q[0];
		cx q[1], q[2];
		h q[2];
		h q[0];
		h q[1];
		h q[2];
		measure q[0];
		measure q[1];
		measure q[2];""",result_probability=(0.25,0.25,0.25,0.25))
	program_deutschjozsa_constant_n3=Program("""h q[0];
		h q[1];
		h q[2];
		h q[0];
		h q[1];
		h q[2];
		measure q[0];
		measure q[1];
		measure q[2];""",result_probability=(1.0,0,0,0))
	
	# IBM Section V, page 2 Quantum Repetition Code
	program_encoder_into_bitflip_code=Program("""h q[2];
		t q[2];
		h q[2];
		h q[1];
		h q[2];
		h q[3];
		cx q[1], q[2];
		cx q[3], q[2];
		h q[1];
		h q[2];
		h q[3];
		measure q[1];
		measure q[2];
		measure q[3];""",result_probability=(0.854,0,0,0,0,0,0,0.146))
	program_encoder_and_decoder_tomography=Program("""h q[2];
		h q[1];
		h q[2];
		h q[3];
		cx q[1], q[2];
		cx q[3], q[2];
		h q[1];
		h q[2];
		h q[3];
		id q[1];
		id q[2];
		id q[3];
		id q[1];
		id q[2];
		id q[3];
		id q[1];
		id q[2];
		id q[3];
		h q[1];
		h q[2];
		h q[3];
		cx q[3], q[2];
		cx q[1], q[2];
		h q[1];
		h q[3];
		cx q[3], q[2];
		tdg q[2];
		cx q[1], q[2];
		t q[2];
		cx q[3], q[2];
		tdg q[2];
		cx q[1], q[2];
		t q[2];
		h q[2];
		bloch q[2];""",bloch_vals=(None,None,(1,0,0),None,None)) # Bloch q2: (1,0,0)
	program_encoder_into_bitflip_code_parity_checks=Program("""h q[2];
		t q[2];
		h q[2];
		h q[0];
		h q[1];
		h q[2];
		cx q[1], q[2];
		cx q[0], q[2];
		h q[0];
		h q[1];
		h q[3];
		cx q[3], q[2];
		h q[2];
		h q[3];
		cx q[3], q[2];
		cx q[0], q[2];
		cx q[1], q[2];
		h q[2];
		h q[4];
		cx q[4], q[2];
		h q[2];
		h q[4];
		cx q[4], q[2];
		cx q[1], q[2];
		cx q[3], q[2];
		measure q[2];
		measure q[4];
		measure q[0];
		measure q[1];
		measure q[3];""",result_probability=(0.852,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0.146,0,0,0,0,0)) # 00000: 0.854; 11010: 0.146
	# IBM Section V, page 3 Stabilizer measurements
	program_plaquette_z0000=Program("""id q[0];
		id q[1];
		id q[3];
		id q[4];
		cx q[4], q[2];
		cx q[0], q[2];
		cx q[3], q[2];
		cx q[1], q[2];
		measure q[2];""",result_probability=(1.0,0))
	program_plaquette_z0001=Program("""id q[0];
		id q[1];
		id q[3];
		x q[4];
		cx q[4], q[2];
		cx q[0], q[2];
		cx q[3], q[2];
		cx q[1], q[2];
		measure q[2];""",result_probability=(0,1.0))
	program_plaquette_z0010=Program("""id q[0];
		id q[1];
		x q[3];
		id q[4];
		cx q[4], q[2];
		cx q[0], q[2];
		cx q[3], q[2];
		cx q[1], q[2];
		measure q[2];""",result_probability=(0,1.0))
	program_plaquette_z0011=Program("""id q[0];
		id q[1];
		x q[3];
		x q[4];
		cx q[4], q[2];
		cx q[0], q[2];
		cx q[3], q[2];
		cx q[1], q[2];
		measure q[2];""",result_probability=(1.0,0))
	program_plaquette_z0100=Program("""id q[0];
		x q[1];
		id q[3];
		id q[4];
		cx q[4], q[2];
		cx q[0], q[2];
		cx q[3], q[2];
		cx q[1], q[2];
		measure q[2];""",result_probability=(0,1.0))
	program_plaquette_z0101=Program("""id q[0];
		x q[1];
		id q[3];
		x q[4];
		cx q[4], q[2];
		cx q[0], q[2];
		cx q[3], q[2];
		cx q[1], q[2];
		measure q[2];""",result_probability=(1.0,0))
	program_plaquette_z0110=Program("""id q[0];
		x q[1];
		x q[3];
		id q[4];
		cx q[4], q[2];
		cx q[0], q[2];
		cx q[3], q[2];
		cx q[1], q[2];
		measure q[2];""",result_probability=(1.0,0))
	program_plaquette_z0111=Program("""id q[0];
		x q[1];
		x q[3];
		x q[4];
		cx q[4], q[2];
		cx q[0], q[2];
		cx q[3], q[2];
		cx q[1], q[2];
		measure q[2];""",result_probability=(0,1.0))
	program_plaquette_z1000=Program("""x q[0];
		id q[1];
		id q[3];
		id q[4];
		cx q[4], q[2];
		cx q[0], q[2];
		cx q[3], q[2];
		cx q[1], q[2];
		measure q[2];""",result_probability=(0,1.0))
	program_plaquette_z1001=Program("""x q[0];
		id q[1];
		id q[3];
		x q[4];
		cx q[4], q[2];
		cx q[0], q[2];
		cx q[3], q[2];
		cx q[1], q[2];
		measure q[2];""",result_probability=(1.0,0))
	program_plaquette_z1010=Program("""x q[0];
		id q[1];
		x q[3];
		id q[4];
		cx q[4], q[2];
		cx q[0], q[2];
		cx q[3], q[2];
		cx q[1], q[2];
		measure q[2];""",result_probability=(1.0,0))
	program_plaquette_z1011=Program("""x q[0];
		id q[1];
		x q[3];
		x q[4];
		cx q[4], q[2];
		cx q[0], q[2];
		cx q[3], q[2];
		cx q[1], q[2];
		measure q[2];""",result_probability=(0,1.0))
	program_plaquette_z1100=Program("""x q[0];
		x q[1];
		id q[3];
		id q[4];
		cx q[4], q[2];
		cx q[0], q[2];
		cx q[3], q[2];
		cx q[1], q[2];
		measure q[2];""",result_probability=(1.0,0))
	program_plaquette_z1101=Program("""x q[0];
		x q[1];
		id q[3];
		x q[4];
		cx q[4], q[2];
		cx q[0], q[2];
		cx q[3], q[2];
		cx q[1], q[2];
		measure q[2];""",result_probability=(0,1.0))
	program_plaquette_z1110=Program("""x q[0];
		x q[1];
		x q[3];
		id q[4];
		cx q[4], q[2];
		cx q[0], q[2];
		cx q[3], q[2];
		cx q[1], q[2];
		measure q[2];""",result_probability=(0,1.0))
	program_plaquette_z1111=Program("""x q[0];
		x q[1];
		x q[3];
		x q[4];
		cx q[4], q[2];
		cx q[0], q[2];
		cx q[3], q[2];
		cx q[1], q[2];
		measure q[2];""",result_probability=(1.0,0))
	program_plaquette_zXplusminusplusminus=Program("""h q[0];
		h q[1];
		h q[3];
		h q[4];
		z q[1];
		z q[4];
		id q[0];
		id q[1];
		id q[3];
		id q[4];
		h q[0];
		h q[1];
		h q[3];
		h q[4];
		cx q[4], q[2];
		cx q[3], q[2];
		cx q[0], q[2];
		cx q[1], q[2];
		h q[0];
		h q[1];
		measure q[2];
		h q[3];
		h q[4];""",result_probability=(1.0,0))
	# Convenience for testing
 	all_normal_plaquette_programs=[program_plaquette_z0000,program_plaquette_z0001,program_plaquette_z0010,program_plaquette_z0011,program_plaquette_z0100,program_plaquette_z0101,program_plaquette_z0110,program_plaquette_z0111,program_plaquette_z1000,program_plaquette_z1001,program_plaquette_z1010,program_plaquette_z1011,program_plaquette_z1100,program_plaquette_z1101,program_plaquette_z1110,program_plaquette_z1111]

#########################################################################################
# All test code below
#########################################################################################
class TestQuantumRegister(unittest.TestCase):
	def setUp(self):
		self.startTime = time.time()
		self.q0 = QuantumRegister("q0")
		self.q1 = QuantumRegister("q1")
	def tearDown(self):
		print self._testMethodName, "%.3f" % (time.time() - self.startTime)
		self.q0=None
		self.q1=None
	def test_get_num_qubits(self):
		self.assertTrue(self.q0.get_num_qubits()==self.q0.get_num_qubits()==1)
	def test_equality(self):
		self.assertEqual(self.q0,self.q0)
		self.assertNotEqual(self.q0,self.q1)

class TestMeasure(unittest.TestCase):
	def setUp(self):
		self.startTime = time.time()
	def tearDown(self):
		print self._testMethodName, "%.3f" % (time.time() - self.startTime)
	def test_measure_probs_plus(self):
		measurements=[]
		for i in range(100000):
		 	measurements+=[State.measure(State.plus_state)]
		result=(1.*sum(measurements))/len(measurements)
		self.assertTrue(np.allclose(list(result.flat),np.array((0.5,0.5)),rtol=1e-2))
	def test_measure_probs_minus(self):
		measurements=[]
		for i in range(100000):
		 	measurements+=[State.measure(State.minus_state)]
		result=(1.*sum(measurements))/len(measurements)
		self.assertTrue(np.allclose(list(result.flat),np.array((0.5,0.5)),rtol=1e-2))
	def test_collapse(self):
		result=None
		for i in range(100):
			if result==None:
				result=State.measure(State.minus_state)
			else:
				new_measure=State.measure(result)
				self.assertTrue(np.allclose(result,new_measure))
				result=new_measure
	def test_measure_bell(self):
		""" Tests the measurement of a 2 qubit entangled system"""	
		measurements=[]
		for i in range(100000):
		 	measurements+=[State.measure(State.bell_state)]
		result=(1.*sum(measurements))/len(measurements)
		self.assertTrue(np.allclose(list(result.flat),np.array((0.5,0.0,0.0,0.5)),rtol=1e-2))

class TestGetBloch(unittest.TestCase):
	def setUp(self):
		self.startTime = time.time()
	def tearDown(self):
		print self._testMethodName, "%.3f" % (time.time() - self.startTime)
	def test_get_bloch(self):
		self.assertTrue(np.allclose(State.get_bloch(State.zero_state),np.array((0,0,1))))
		self.assertTrue(np.allclose(State.get_bloch(State.one_state),np.array((0,0,-1))))
		self.assertTrue(np.allclose(State.get_bloch(State.plusi_state),np.array((0,1,0))))
		self.assertTrue(np.allclose(State.get_bloch(State.minusi_state),np.array((0,-1,0))))
		self.assertTrue(np.allclose(State.get_bloch(Gate.Z*State.plus_state),np.array((-1,0,0))))
		self.assertTrue(np.allclose(State.get_bloch(Gate.Z*State.minus_state),np.array((1,0,0))))

		# assert the norms are 1 for cardinal points (obviously) but also for a few other points at higher T depth on the Bloch Sphere
		for state in [State.zero_state,State.one_state,State.plusi_state,State.minusi_state,Gate.Z*State.plus_state,Gate.H*Gate.T*Gate.Z*State.plus_state,Gate.H*Gate.T*Gate.H*Gate.T*Gate.H*Gate.T*Gate.Z*State.plus_state]:
			self.assertAlmostEqual(np.linalg.norm(state),1.0)

class TestGetBloch2(unittest.TestCase):
	def setUp(self):
		self.startTime = time.time()
	def tearDown(self):
		print self._testMethodName, "%.3f" % (time.time() - self.startTime)
	def get_bloch_2(self,state):
		""" equal to get_bloch just a different way of calculating things. Used for testing get_bloch. """
		return np.array((((state*state.conjugate().transpose()*Gate.X).trace()).item(0),((state*state.conjugate().transpose()*Gate.Y).trace()).item(0),((state*state.conjugate().transpose()*Gate.Z).trace()).item(0)))

	def test_get_bloch_2(self):
		self.assertTrue(np.allclose(self.get_bloch_2(State.zero_state),State.get_bloch(State.zero_state)))
		self.assertTrue(np.allclose(self.get_bloch_2(State.one_state),State.get_bloch(State.one_state)))
		self.assertTrue(np.allclose(self.get_bloch_2(State.plusi_state),State.get_bloch(State.plusi_state)))
		self.assertTrue(np.allclose(self.get_bloch_2(State.minusi_state),State.get_bloch(State.minusi_state)))
		self.assertTrue(np.allclose(self.get_bloch_2(Gate.Z*State.plus_state),State.get_bloch(Gate.Z*State.plus_state)))
		self.assertTrue(np.allclose(self.get_bloch_2(Gate.H*Gate.T*Gate.Z*State.plus_state),State.get_bloch(Gate.H*Gate.T*Gate.Z*State.plus_state))) # test for arbitrary gates


class TestCNOTGate(unittest.TestCase):	
	def setUp(self):
		self.startTime = time.time()
	def tearDown(self):
		print self._testMethodName, "%.3f" % (time.time() - self.startTime)
	def test_CNOT(self):
		self.assertTrue(np.allclose(Gate.CNOT2_01*State.state_from_string('00'),State.state_from_string('00')))
		self.assertTrue(np.allclose(Gate.CNOT2_01*State.state_from_string('01'),State.state_from_string('01')))
		self.assertTrue(np.allclose(Gate.CNOT2_01*State.state_from_string('10'),State.state_from_string('11')))
		self.assertTrue(np.allclose(Gate.CNOT2_01*State.state_from_string('11'),State.state_from_string('10')))

class TestTGate(unittest.TestCase):
	def setUp(self):
		self.startTime = time.time()
	def tearDown(self):
		print self._testMethodName, "%.3f" % (time.time() - self.startTime)
	def test_T(self):
		# This is useful to check some of the exercises on IBM's quantum experience. 
		# "Ground truth" answers from IBM's calculations which unfortunately are not reported to high precision.
		red_state=Gate.S*Gate.T*Gate.H*Gate.T*Gate.H*State.zero_state
		green_state=Gate.S*Gate.H*Gate.T*Gate.H*Gate.T*Gate.H*Gate.T*Gate.H*Gate.S*Gate.T*Gate.H*Gate.T*Gate.H*State.zero_state
		blue_state=Gate.H*Gate.S*Gate.T*Gate.H*Gate.T*Gate.H*Gate.S*Gate.T*Gate.H*Gate.T*Gate.H*Gate.T*Gate.H*State.zero_state
		self.assertTrue(np.allclose(State.get_bloch(red_state),np.array((0.5,0.5,0.707)),rtol=1e-3))
		self.assertTrue(np.allclose(State.get_bloch(green_state),np.array((0.427,0.457,0.780)),rtol=1e-3))
		self.assertTrue(np.allclose(State.get_bloch(blue_state),np.array((0.457,0.427,0.780)),rtol=1e-3))
		# Checking norms
		for state in [red_state,green_state,blue_state]:
			self.assertAlmostEqual(np.linalg.norm(state),1.0)

class TestMultiQuantumRegisterStates(unittest.TestCase):
	def setUp(self):
		self.startTime = time.time()
		## Two qubit states (basis)
		# To derive the ordering you do ((+) is outer product):
		# Symbolically: |00> = |0> (+) |0>; gives 4x1 
		# In Python: np.kron(zero_state,zero_state)
		self.two_qubits_00=np.kron(State.zero_state,State.zero_state)
		self.two_qubits_01=np.kron(State.zero_state,State.one_state)
		self.two_qubits_10=np.kron(State.one_state,State.zero_state)
		self.two_qubits_11=np.kron(State.one_state,State.one_state)

		## Three qubit states (basis)
		self.three_qubits_000=np.kron(self.two_qubits_00,State.zero_state)
		self.three_qubits_001=np.kron(self.two_qubits_00,State.one_state)
		self.three_qubits_010=np.kron(self.two_qubits_01,State.zero_state)
		self.three_qubits_011=np.kron(self.two_qubits_01,State.one_state)
		self.three_qubits_100=np.kron(self.two_qubits_10,State.zero_state)
		self.three_qubits_101=np.kron(self.two_qubits_10,State.one_state)
		self.three_qubits_110=np.kron(self.two_qubits_11,State.zero_state)
		self.three_qubits_111=np.kron(self.two_qubits_11,State.one_state)

		# Four qubit states (basis)
		self.four_qubits_0000=np.kron(self.three_qubits_000,State.zero_state)
		self.four_qubits_0001=np.kron(self.three_qubits_000,State.one_state)
		self.four_qubits_0010=np.kron(self.three_qubits_001,State.zero_state)
		self.four_qubits_0011=np.kron(self.three_qubits_001,State.one_state)
		self.four_qubits_0100=np.kron(self.three_qubits_010,State.zero_state)
		self.four_qubits_0101=np.kron(self.three_qubits_010,State.one_state)
		self.four_qubits_0110=np.kron(self.three_qubits_011,State.zero_state)
		self.four_qubits_0111=np.kron(self.three_qubits_011,State.one_state)
		self.four_qubits_1000=np.kron(self.three_qubits_100,State.zero_state)
		self.four_qubits_1001=np.kron(self.three_qubits_100,State.one_state)
		self.four_qubits_1010=np.kron(self.three_qubits_101,State.zero_state)
		self.four_qubits_1011=np.kron(self.three_qubits_101,State.one_state)
		self.four_qubits_1100=np.kron(self.three_qubits_110,State.zero_state)
		self.four_qubits_1101=np.kron(self.three_qubits_110,State.one_state)
		self.four_qubits_1110=np.kron(self.three_qubits_111,State.zero_state)
		self.four_qubits_1111=np.kron(self.three_qubits_111,State.one_state)

		# Five qubit states (basis)
		self.five_qubits_00000=np.kron(self.four_qubits_0000,State.zero_state)
		self.five_qubits_00001=np.kron(self.four_qubits_0000,State.one_state)
		self.five_qubits_00010=np.kron(self.four_qubits_0001,State.zero_state)
		self.five_qubits_00011=np.kron(self.four_qubits_0001,State.one_state)
		self.five_qubits_00100=np.kron(self.four_qubits_0010,State.zero_state)
		self.five_qubits_00101=np.kron(self.four_qubits_0010,State.one_state)
		self.five_qubits_00110=np.kron(self.four_qubits_0011,State.zero_state)
		self.five_qubits_00111=np.kron(self.four_qubits_0011,State.one_state)
		self.five_qubits_01000=np.kron(self.four_qubits_0100,State.zero_state)
		self.five_qubits_01001=np.kron(self.four_qubits_0100,State.one_state)
		self.five_qubits_01010=np.kron(self.four_qubits_0101,State.zero_state)
		self.five_qubits_01011=np.kron(self.four_qubits_0101,State.one_state)
		self.five_qubits_01100=np.kron(self.four_qubits_0110,State.zero_state)
		self.five_qubits_01101=np.kron(self.four_qubits_0110,State.one_state)
		self.five_qubits_01110=np.kron(self.four_qubits_0111,State.zero_state)
		self.five_qubits_01111=np.kron(self.four_qubits_0111,State.one_state)
		self.five_qubits_10000=np.kron(self.four_qubits_1000,State.zero_state)
		self.five_qubits_10001=np.kron(self.four_qubits_1000,State.one_state)
		self.five_qubits_10010=np.kron(self.four_qubits_1001,State.zero_state)
		self.five_qubits_10011=np.kron(self.four_qubits_1001,State.one_state)
		self.five_qubits_10100=np.kron(self.four_qubits_1010,State.zero_state)
		self.five_qubits_10101=np.kron(self.four_qubits_1010,State.one_state)
		self.five_qubits_10110=np.kron(self.four_qubits_1011,State.zero_state)
		self.five_qubits_10111=np.kron(self.four_qubits_1011,State.one_state)
		self.five_qubits_11000=np.kron(self.four_qubits_1100,State.zero_state)
		self.five_qubits_11001=np.kron(self.four_qubits_1100,State.one_state)
		self.five_qubits_11010=np.kron(self.four_qubits_1101,State.zero_state)
		self.five_qubits_11011=np.kron(self.four_qubits_1101,State.one_state)
		self.five_qubits_11100=np.kron(self.four_qubits_1110,State.zero_state)
		self.five_qubits_11101=np.kron(self.four_qubits_1110,State.one_state)
		self.five_qubits_11110=np.kron(self.four_qubits_1111,State.zero_state)
		self.five_qubits_11111=np.kron(self.four_qubits_1111,State.one_state)
	def tearDown(self):
		print self._testMethodName, "%.3f" % (time.time() - self.startTime)
	def test_basis(self):
		# Sanity checks
		# 1-qubit
		self.assertTrue(np.allclose(State.zero_state+State.one_state,np.matrix('1; 1')))
		eye=np.eye(2,2)
		for row,state in enumerate([State.zero_state,State.one_state]):
			self.assertTrue(np.allclose(state.transpose(),eye[row]))
		# 2-qubit
		self.assertTrue(np.allclose(self.two_qubits_00+self.two_qubits_01+self.two_qubits_10+self.two_qubits_11,np.matrix('1; 1; 1; 1')))
		eye=np.eye(4,4)
		for row,state in enumerate([self.two_qubits_00,self.two_qubits_01,self.two_qubits_10,self.two_qubits_11]):
			self.assertTrue(np.allclose(state.transpose(),eye[row]))
		# 3-qubit
		self.assertTrue(np.allclose(self.three_qubits_000+self.three_qubits_001+self.three_qubits_010+self.three_qubits_011+self.three_qubits_100+self.three_qubits_101+self.three_qubits_110+self.three_qubits_111,np.matrix('1; 1; 1; 1; 1; 1; 1; 1')))
		eye=np.eye(8,8)
		for row,state in enumerate([self.three_qubits_000,self.three_qubits_001,self.three_qubits_010,self.three_qubits_011,self.three_qubits_100,self.three_qubits_101,self.three_qubits_110,self.three_qubits_111]):
			self.assertTrue(np.allclose(state.transpose(),eye[row]))
		# 4-qubit
		self.assertTrue(np.allclose(self.four_qubits_0000+self.four_qubits_0001+self.four_qubits_0010+self.four_qubits_0011+self.four_qubits_0100+self.four_qubits_0101+self.four_qubits_0110+self.four_qubits_0111+self.four_qubits_1000+self.four_qubits_1001+self.four_qubits_1010+self.four_qubits_1011+self.four_qubits_1100+self.four_qubits_1101+self.four_qubits_1110+self.four_qubits_1111,np.matrix('1; 1; 1; 1; 1; 1; 1; 1; 1; 1; 1; 1; 1; 1; 1; 1')))
		eye=np.eye(16,16)
		for row,state in enumerate([self.four_qubits_0000,self.four_qubits_0001,self.four_qubits_0010,self.four_qubits_0011,self.four_qubits_0100,self.four_qubits_0101,self.four_qubits_0110,self.four_qubits_0111,self.four_qubits_1000,self.four_qubits_1001,self.four_qubits_1010,self.four_qubits_1011,self.four_qubits_1100,self.four_qubits_1101,self.four_qubits_1110,self.four_qubits_1111]):
			self.assertTrue(np.allclose(state.transpose(),eye[row]))
		# 5-qubit
		self.assertTrue(np.allclose(self.five_qubits_00000+self.five_qubits_00001+self.five_qubits_00010+self.five_qubits_00011+self.five_qubits_00100+self.five_qubits_00101+self.five_qubits_00110+self.five_qubits_00111+self.five_qubits_01000+self.five_qubits_01001+self.five_qubits_01010+self.five_qubits_01011+self.five_qubits_01100+self.five_qubits_01101+self.five_qubits_01110+self.five_qubits_01111+self.five_qubits_10000+self.five_qubits_10001+self.five_qubits_10010+self.five_qubits_10011+self.five_qubits_10100+self.five_qubits_10101+self.five_qubits_10110+self.five_qubits_10111+self.five_qubits_11000+self.five_qubits_11001+self.five_qubits_11010+self.five_qubits_11011+self.five_qubits_11100+self.five_qubits_11101+self.five_qubits_11110+self.five_qubits_11111,np.matrix('1; 1; 1; 1; 1; 1; 1; 1; 1; 1; 1; 1; 1; 1; 1; 1; 1; 1; 1; 1; 1; 1; 1; 1; 1; 1; 1; 1; 1; 1; 1; 1')))
		eye=np.eye(32,32)
		for row,state in enumerate([self.five_qubits_00000,self.five_qubits_00001,self.five_qubits_00010,self.five_qubits_00011,self.five_qubits_00100,self.five_qubits_00101,self.five_qubits_00110,self.five_qubits_00111,self.five_qubits_01000,self.five_qubits_01001,self.five_qubits_01010,self.five_qubits_01011,self.five_qubits_01100,self.five_qubits_01101,self.five_qubits_01110,self.five_qubits_01111,self.five_qubits_10000,self.five_qubits_10001,self.five_qubits_10010,self.five_qubits_10011,self.five_qubits_10100,self.five_qubits_10101,self.five_qubits_10110,self.five_qubits_10111,self.five_qubits_11000,self.five_qubits_11001,self.five_qubits_11010,self.five_qubits_11011,self.five_qubits_11100,self.five_qubits_11101,self.five_qubits_11110,self.five_qubits_11111]):
			self.assertTrue(np.allclose(state.transpose(),eye[row]))

	def test_separate_state(self):
		value_groups=[State.separate_state(self.five_qubits_11010),
			State.separate_state(self.four_qubits_0101),
			State.separate_state(self.three_qubits_000),
			State.separate_state(self.three_qubits_111),
			State.separate_state(self.three_qubits_101),
			State.separate_state(self.two_qubits_00),
			State.separate_state(self.two_qubits_01),
			State.separate_state(self.two_qubits_10),
			State.separate_state(self.two_qubits_11),
			State.separate_state(State.zero_state),
			State.separate_state(State.one_state)]

		target_groups=[(State.one_state,State.one_state,State.zero_state,State.one_state,State.zero_state),
			(State.zero_state,State.one_state,State.zero_state,State.one_state),
			(State.zero_state,State.zero_state,State.zero_state),
			(State.one_state,State.one_state,State.one_state),
			(State.one_state,State.zero_state,State.one_state),
			(State.zero_state,State.zero_state),
			(State.zero_state,State.one_state),
			(State.one_state,State.zero_state),
			(State.one_state,State.one_state),
			(State.zero_state),
			(State.one_state)]
		for vg,tg in zip(value_groups,target_groups):
			for value_state,target_state in zip(value_groups,target_groups):
				self.assertTrue(np.allclose(value_state,target_state)) 			

	def test_string_from_state(self):
		self.assertEqual(State.string_from_state(State.zero_state),'0')
		self.assertEqual(State.string_from_state(State.one_state),'1')
		self.assertEqual(State.string_from_state(self.two_qubits_00),'00')
		self.assertEqual(State.string_from_state(self.two_qubits_01),'01')
		self.assertEqual(State.string_from_state(self.two_qubits_10),'10')
		self.assertEqual(State.string_from_state(self.two_qubits_11),'11')
		self.assertEqual(State.string_from_state(self.three_qubits_110),'110')
		self.assertEqual(State.string_from_state(self.four_qubits_1101),'1101')
		self.assertEqual(State.string_from_state(self.five_qubits_11010),'11010')

	def test_state_from_string(self):
		for value_group,target_group in zip(['0','1','00','01','10','11','110','1101','11010'],
								[[State.zero_state],[State.one_state],[State.zero_state,State.zero_state],[State.zero_state,State.one_state],[State.one_state,State.zero_state],[State.one_state,State.one_state],[State.one_state,State.one_state,State.zero_state],[State.one_state,State.one_state,State.zero_state,State.one_state],[State.one_state,State.one_state,State.zero_state,State.one_state,State.zero_state]]):
			self.assertEqual(value_group,State.string_from_state(State.state_from_string(value_group)))
			value_group=State.separate_state(State.state_from_string(value_group))
			self.assertEqual(len(value_group),len(target_group)) 
			for value_state,target_state in zip(value_group,target_group):
				self.assertTrue(np.allclose(value_state,target_state)) 

class TestQuantumComputer(unittest.TestCase):
	def setUp(self):
		self.startTime = time.time()
		self.qc=QuantumComputer()
	def test_apply_gate(self):
		self.qc.apply_gate(Gate.H*Gate.T*Gate.Sdagger*Gate.Tdagger*Gate.X*Gate.Y,"q0")
		self.assertTrue(self.qc.qubit_states_equal("q0",Gate.H*Gate.T*Gate.Sdagger*Gate.Tdagger*Gate.X*Gate.Y*State.zero_state))
		# Some tests on entangled gates, breaking abstraction but will improve testing soon
		self.qc.reset()
		q0=self.qc.qubits.get_quantum_register_containing("q0")
		q1=self.qc.qubits.get_quantum_register_containing("q1")
		q0.set_state(np.kron(State.zero_state,State.zero_state))
		self.qc.qubits.entangle_quantum_registers(q0,q1)

		# We will test applying the gate to qubits one and two
		self.qc.apply_gate(Gate.X,"q0")
		self.assertEqual(State.string_from_state(self.qc.qubits.get_quantum_register_containing("q0").get_state()),'10')
		self.qc.apply_gate(Gate.X,"q0")
		self.assertEqual(State.string_from_state(self.qc.qubits.get_quantum_register_containing("q0").get_state()),'00')

		self.assertEqual(self.qc.qubits.get_quantum_register_containing("q1").name,"q1")
		self.qc.apply_gate(Gate.X,"q1")
		self.assertEqual(State.string_from_state(self.qc.qubits.get_quantum_register_containing("q0").get_state()),'01')
		self.qc.apply_gate(Gate.X,"q1")
		self.assertEqual(State.string_from_state(self.qc.qubits.get_quantum_register_containing("q0").get_state()),'00')
		self.qc.apply_gate(Gate.X,"q0")
		self.assertEqual(State.string_from_state(self.qc.qubits.get_quantum_register_containing("q0").get_state()),'10')
		self.qc.apply_gate(Gate.X,"q1")
		self.assertEqual(State.string_from_state(self.qc.qubits.get_quantum_register_containing("q0").get_state()),'11')

		# Now testing on 3 qubits
		q3=self.qc.qubits.get_quantum_register_containing("q3")
		q0.set_state(np.kron(np.kron(State.zero_state,State.zero_state),State.zero_state))
		self.qc.qubits.entangle_quantum_registers(q0,q3)
		self.assertEqual(self.qc.qubits.get_quantum_register_containing("q1").name,"q1")
		self.assertEqual(self.qc.qubits.get_quantum_register_containing("q3").name,"q3")
		self.assertEqual(self.qc.qubits.get_quantum_register_containing("q0").name,"q0")
		self.assertEqual(self.qc.qubits.get_quantum_register_containing("q2").name,"q2")
		self.assertEqual(self.qc.qubits.get_quantum_register_containing("q4").name,"q4")

		self.qc.apply_gate(Gate.X,"q0")
		self.assertEqual(State.string_from_state(self.qc.qubits.get_quantum_register_containing("q0").get_state()),'100')
		self.qc.apply_gate(Gate.X,"q0")
		self.assertEqual(State.string_from_state(self.qc.qubits.get_quantum_register_containing("q0").get_state()),'000')
		self.assertEqual(self.qc.qubits.get_quantum_register_containing("q1").name,"q1")
		self.qc.apply_gate(Gate.X,"q1")
		self.assertEqual(State.string_from_state(self.qc.qubits.get_quantum_register_containing("q0").get_state()),'010')
		self.qc.apply_gate(Gate.X,"q1")
		self.assertEqual(State.string_from_state(self.qc.qubits.get_quantum_register_containing("q0").get_state()),'000')
		self.qc.apply_gate(Gate.X,"q0")
		self.assertEqual(State.string_from_state(self.qc.qubits.get_quantum_register_containing("q0").get_state()),'100')
		self.qc.apply_gate(Gate.X,"q1")
		self.assertEqual(State.string_from_state(self.qc.qubits.get_quantum_register_containing("q0").get_state()),'110')
		self.qc.apply_gate(Gate.X,"q3")
		self.assertEqual(State.string_from_state(self.qc.qubits.get_quantum_register_containing("q0").get_state()),'111')
		self.qc.apply_gate(Gate.X,"q1")
		self.assertEqual(State.string_from_state(self.qc.qubits.get_quantum_register_containing("q0").get_state()),'101')
		self.qc.apply_gate(Gate.X,"q4")
		self.assertEqual(State.string_from_state(self.qc.qubits.get_quantum_register_containing("q4").get_state()),'1')
		self.qc.apply_gate(Gate.X,"q4")
		self.assertEqual(State.string_from_state(self.qc.qubits.get_quantum_register_containing("q4").get_state()),'0')


	def test_apply_two_qubit_gate_CNOT_target(self):
		self.assertTrue(self.qc.qubit_states_equal("q0",State.zero_state))
		self.assertTrue(self.qc.qubit_states_equal("q1",State.zero_state))
		self.qc.apply_two_qubit_gate_CNOT("q0","q1")
		self.assertTrue(self.qc.qubit_states_equal("q0",State.zero_state))
		self.assertTrue(self.qc.qubit_states_equal("q1",State.zero_state))
		self.qc.apply_gate(Gate.X,"q0")
		self.qc.apply_two_qubit_gate_CNOT("q0","q1")
		self.assertTrue(self.qc.qubit_states_equal("q0",State.one_state))
		self.assertTrue(self.qc.qubit_states_equal("q1",State.one_state))
		self.qc.apply_two_qubit_gate_CNOT("q0","q1")
		self.assertTrue(self.qc.qubit_states_equal("q0",State.one_state))
		self.assertTrue(self.qc.qubit_states_equal("q1",State.zero_state))

	def test_apply_two_qubit_gate_CNOT_two_entangled_target(self):
		# We'll put qubit0 in state |10> and qubit1 is in state |0>
		q0=self.qc.qubits.get_quantum_register_containing("q0")
		q1=self.qc.qubits.get_quantum_register_containing("q1")
		q0.set_state(State.state_from_string("10"))
		self.qc.qubits.entangle_quantum_registers(q0,q1)
		self.qc.apply_two_qubit_gate_CNOT("q0","q2") # Before: 100 After: 101
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2",State.state_from_string('101')))
		self.qc.reset()
		q0=self.qc.qubits.get_quantum_register_containing("q0")
		q1=self.qc.qubits.get_quantum_register_containing("q1")
		q0.set_state(State.state_from_string("10"))
		self.qc.qubits.entangle_quantum_registers(q0,q1)
		self.qc.apply_two_qubit_gate_CNOT("q2","q0") # Before: 100 After: 100
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2",State.state_from_string('100')))
		self.qc.apply_two_qubit_gate_CNOT("q0","q1") # Before: 100 After: 110
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2",State.state_from_string('110')))

	def test_apply_two_qubit_gate_CNOT_three_entangled_target(self):
		#Entangled already
		# Put q0 in an entangled state: |000>
		for target,control in itertools.product(["q0","q1","q2"],repeat=2):
			if target!=control:
				self.qc.reset()
				q0=self.qc.qubits.get_quantum_register_containing("q0")
				q1=self.qc.qubits.get_quantum_register_containing("q1")
				q2=self.qc.qubits.get_quantum_register_containing("q2")
				q0.set_state(State.state_from_string("000"))
				self.qc.qubits.entangle_quantum_registers(q0,q1)
				self.qc.qubits.entangle_quantum_registers(q0,q2)
				self.assertEqual(QuantumRegister.num_qubits(q0.get_state()),3)
				self.qc.apply_two_qubit_gate_CNOT(target,control)
				self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2",State.state_from_string('000')))
		self.qc.reset()
		q0=self.qc.qubits.get_quantum_register_containing("q0")
		q1=self.qc.qubits.get_quantum_register_containing("q1")
		q2=self.qc.qubits.get_quantum_register_containing("q2")
		q0.set_state(State.state_from_string("100"))
		self.qc.qubits.entangle_quantum_registers(q0,q1)
		self.qc.qubits.entangle_quantum_registers(q0,q2)
		self.qc.apply_two_qubit_gate_CNOT("q0","q1") # Before: 100 After: 110
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2",State.state_from_string('110')))
		self.qc.apply_two_qubit_gate_CNOT("q1","q0") # Before: 110 After: 010
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2",State.state_from_string('010')))
		self.qc.apply_two_qubit_gate_CNOT("q0","q1") # Before: 010 After: 010
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2",State.state_from_string('010')))
		self.qc.apply_two_qubit_gate_CNOT("q2","q1") # Before: 010 After: 010
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2",State.state_from_string('010')))
		self.qc.apply_two_qubit_gate_CNOT("q1","q2") # Before: 010 After: 011
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2",State.state_from_string('011')))
		self.qc.apply_two_qubit_gate_CNOT("q2","q1") # Before: 011 After: 001
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2",State.state_from_string('001')))
		self.qc.apply_two_qubit_gate_CNOT("q0","q1") # Before: 001 After: 001
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2",State.state_from_string('001')))
		self.qc.apply_two_qubit_gate_CNOT("q1","q0") # Before: 001 After: 001
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2",State.state_from_string('001')))
		self.qc.apply_two_qubit_gate_CNOT("q1","q2") # Before: 001 After: 001
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2",State.state_from_string('001')))
		self.qc.apply_two_qubit_gate_CNOT("q0","q2") # Before: 001 After: 001
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2",State.state_from_string('001')))
		self.qc.apply_two_qubit_gate_CNOT("q2","q1") # Before: 001 After: 011
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2",State.state_from_string('011')))
		self.qc.apply_two_qubit_gate_CNOT("q2","q0") # Before: 011 After: 111
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2",State.state_from_string('111')))
		self.qc.apply_two_qubit_gate_CNOT("q0","q2") # Before: 111 After: 110
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2",State.state_from_string('110')))
		self.qc.apply_two_qubit_gate_CNOT("q2","q1") # Before: 110 After: 110
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2",State.state_from_string('110')))
		self.qc.apply_two_qubit_gate_CNOT("q2","q0") # Before: 110 After: 110
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2",State.state_from_string('110')))

	def test_apply_two_qubit_gate_CNOT_four_entangled_target(self):
		#Entangled already
		# Put q0 in an entangled state: |0000>
		for target,control in itertools.product(["q0","q1","q2","q3"],repeat=2):
			if target!=control:
				self.qc.reset()
				q0=self.qc.qubits.get_quantum_register_containing("q0")
				q1=self.qc.qubits.get_quantum_register_containing("q1")
				q2=self.qc.qubits.get_quantum_register_containing("q2")
				q3=self.qc.qubits.get_quantum_register_containing("q3")
				q0.set_state(State.state_from_string("0000"))
				self.qc.qubits.entangle_quantum_registers(q0,q1)
				self.qc.qubits.entangle_quantum_registers(q0,q2)
				self.qc.qubits.entangle_quantum_registers(q0,q3)

				self.assertEqual(QuantumRegister.num_qubits(q0.get_state()),4)
				self.qc.apply_two_qubit_gate_CNOT(target,control)
				self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2,q3",State.state_from_string('0000')))
		self.qc.reset()
		q0=self.qc.qubits.get_quantum_register_containing("q0")
		q1=self.qc.qubits.get_quantum_register_containing("q1")
		q2=self.qc.qubits.get_quantum_register_containing("q2")
		q3=self.qc.qubits.get_quantum_register_containing("q3")
		q0.set_state(State.state_from_string("1000"))
		self.qc.qubits.entangle_quantum_registers(q0,q1)
		self.qc.qubits.entangle_quantum_registers(q0,q2)
		self.qc.qubits.entangle_quantum_registers(q0,q3)

		self.qc.apply_two_qubit_gate_CNOT("q0","q1") # Before: 1000 After: 1100
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2,q3",State.state_from_string('1100')))
		self.qc.apply_two_qubit_gate_CNOT("q1","q0") # Before: 1100 After: 0100
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2,q3",State.state_from_string('0100')))
		self.qc.apply_two_qubit_gate_CNOT("q0","q1") # Before: 0100 After: 0100
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2,q3",State.state_from_string('0100')))
		self.qc.apply_two_qubit_gate_CNOT("q2","q1") # Before: 0100 After: 0100
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2,q3",State.state_from_string('0100')))
		self.qc.apply_two_qubit_gate_CNOT("q1","q2") # Before: 0100 After: 0110
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2,q3",State.state_from_string('0110')))
		self.qc.apply_two_qubit_gate_CNOT("q2","q1") # Before: 0110 After: 0010
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2,q3",State.state_from_string('0010')))
		self.qc.apply_two_qubit_gate_CNOT("q0","q1") # Before: 0010 After: 0010
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2,q3",State.state_from_string('0010')))
		self.qc.apply_two_qubit_gate_CNOT("q1","q0") # Before: 0010 After: 0010
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2,q3",State.state_from_string('0010')))
		self.qc.apply_two_qubit_gate_CNOT("q1","q2") # Before: 0010 After: 0010
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2,q3",State.state_from_string('0010')))
		self.qc.apply_two_qubit_gate_CNOT("q0","q2") # Before: 0010 After: 0010
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2,q3",State.state_from_string('0010')))
		self.qc.apply_two_qubit_gate_CNOT("q2","q1") # Before: 0010 After: 0110
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2,q3",State.state_from_string('0110')))
		self.qc.apply_two_qubit_gate_CNOT("q2","q0") # Before: 0110 After: 1110
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2,q3",State.state_from_string('1110')))
		self.qc.apply_two_qubit_gate_CNOT("q0","q2") # Before: 1110 After: 1100
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2,q3",State.state_from_string('1100')))
		self.qc.apply_two_qubit_gate_CNOT("q2","q1") # Before: 1100 After: 1100
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2,q3",State.state_from_string('1100')))
		self.qc.apply_two_qubit_gate_CNOT("q2","q0") # Before: 1100 After: 1100
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2,q3",State.state_from_string('1100')))
		self.qc.apply_two_qubit_gate_CNOT("q0","q3") # Before: 1100 After: 1101
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2,q3",State.state_from_string('1101')))
		self.qc.apply_two_qubit_gate_CNOT("q3","q2") # Before: 1101 After: 1111
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2,q3",State.state_from_string('1111')))
		self.qc.apply_two_qubit_gate_CNOT("q1","q3") # Before: 1111 After: 1110
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2,q3",State.state_from_string('1110')))
		self.qc.apply_two_qubit_gate_CNOT("q0","q1") # Before: 1110 After: 1010
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2,q3",State.state_from_string('1010')))
		self.qc.apply_two_qubit_gate_CNOT("q1","q3") # Before: 1010 After: 1010
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2,q3",State.state_from_string('1010')))
		self.qc.apply_two_qubit_gate_CNOT("q3","q1") # Before: 1010 After: 1010
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2,q3",State.state_from_string('1010')))

	def test_apply_two_qubit_gate_CNOT_five_entangled_target(self):
		#Entangled already
		# Put q0 in an entangled state: |00000>
		for target,control in itertools.product(["q0","q1","q2","q3","q4"],repeat=2):
			if target!=control:
				self.qc.reset()
				q0=self.qc.qubits.get_quantum_register_containing("q0")
				q1=self.qc.qubits.get_quantum_register_containing("q1")
				q2=self.qc.qubits.get_quantum_register_containing("q2")
				q3=self.qc.qubits.get_quantum_register_containing("q3")
				q4=self.qc.qubits.get_quantum_register_containing("q4")
				q0.set_state(State.state_from_string("00000"))
				self.qc.qubits.entangle_quantum_registers(q0,q1)
				self.qc.qubits.entangle_quantum_registers(q0,q2)
				self.qc.qubits.entangle_quantum_registers(q0,q3)
				self.qc.qubits.entangle_quantum_registers(q0,q4)
				self.assertEqual(QuantumRegister.num_qubits(q0.get_state()),5)
				self.qc.apply_two_qubit_gate_CNOT(target,control)
				self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2,q3,q4",State.state_from_string('00000')))
		self.qc.reset()
		q0=self.qc.qubits.get_quantum_register_containing("q0")
		q1=self.qc.qubits.get_quantum_register_containing("q1")
		q2=self.qc.qubits.get_quantum_register_containing("q2")
		q3=self.qc.qubits.get_quantum_register_containing("q3")
		q4=self.qc.qubits.get_quantum_register_containing("q4")
		q0.set_state(State.state_from_string("10000"))
		self.qc.qubits.entangle_quantum_registers(q0,q1)
		self.qc.qubits.entangle_quantum_registers(q0,q2)
		self.qc.qubits.entangle_quantum_registers(q0,q3)
		self.qc.qubits.entangle_quantum_registers(q0,q4)

		self.qc.apply_two_qubit_gate_CNOT("q0","q1") # Before: 10000 After: 11000
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2,q3,q4",State.state_from_string('11000')))
		self.qc.apply_two_qubit_gate_CNOT("q1","q0") # Before: 11000 After: 01000
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2,q3,q4",State.state_from_string('01000')))
		self.qc.apply_two_qubit_gate_CNOT("q0","q1") # Before: 01000 After: 01000
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2,q3,q4",State.state_from_string('01000')))
		self.qc.apply_two_qubit_gate_CNOT("q2","q1") # Before: 01000 After: 01000
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2,q3,q4",State.state_from_string('01000')))
		self.qc.apply_two_qubit_gate_CNOT("q1","q2") # Before: 01000 After: 01100
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2,q3,q4",State.state_from_string('01100')))
		self.qc.apply_two_qubit_gate_CNOT("q2","q1") # Before: 01100 After: 00100
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2,q3,q4",State.state_from_string('00100')))
		self.qc.apply_two_qubit_gate_CNOT("q0","q1") # Before: 00100 After: 00100
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2,q3,q4",State.state_from_string('00100')))
		self.qc.apply_two_qubit_gate_CNOT("q1","q0") # Before: 00100 After: 00100
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2,q3,q4",State.state_from_string('00100')))
		self.qc.apply_two_qubit_gate_CNOT("q1","q2") # Before: 00100 After: 00100
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2,q3,q4",State.state_from_string('00100')))
		self.qc.apply_two_qubit_gate_CNOT("q0","q2") # Before: 00100 After: 00100
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2,q3,q4",State.state_from_string('00100')))
		self.qc.apply_two_qubit_gate_CNOT("q2","q1") # Before: 00100 After: 01100
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2,q3,q4",State.state_from_string('01100')))
		self.qc.apply_two_qubit_gate_CNOT("q2","q0") # Before: 01100 After: 11100
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2,q3,q4",State.state_from_string('11100')))
		self.qc.apply_two_qubit_gate_CNOT("q0","q2") # Before: 11100 After: 11000
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2,q3,q4",State.state_from_string('11000')))
		self.qc.apply_two_qubit_gate_CNOT("q2","q1") # Before: 11000 After: 11000
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2,q3,q4",State.state_from_string('11000')))
		self.qc.apply_two_qubit_gate_CNOT("q2","q0") # Before: 11000 After: 11000
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2,q3,q4",State.state_from_string('11000')))
		self.qc.apply_two_qubit_gate_CNOT("q0","q3") # Before: 11000 After: 11010
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2,q3,q4",State.state_from_string('11010')))
		self.qc.apply_two_qubit_gate_CNOT("q3","q2") # Before: 11010 After: 11110
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2,q3,q4",State.state_from_string('11110')))
		self.qc.apply_two_qubit_gate_CNOT("q1","q3") # Before: 11110 After: 11100
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2,q3,q4",State.state_from_string('11100')))
		self.qc.apply_two_qubit_gate_CNOT("q0","q1") # Before: 11100 After: 10100
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2,q3,q4",State.state_from_string('10100')))
		self.qc.apply_two_qubit_gate_CNOT("q1","q3") # Before: 10100 After: 10100
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2,q3,q4",State.state_from_string('10100')))
		self.qc.apply_two_qubit_gate_CNOT("q3","q1") # Before: 10100 After: 10100
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2,q3,q4",State.state_from_string('10100')))


		self.qc.apply_two_qubit_gate_CNOT("q0","q4") # Before: 10100 After: 10101
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2,q3,q4",State.state_from_string('10101')))
		self.qc.apply_two_qubit_gate_CNOT("q4","q2") # Before: 10101 After: 10001
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2,q3,q4",State.state_from_string('10001')))
		self.qc.apply_two_qubit_gate_CNOT("q1","q4") # Before: 10001 After: 10001
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2,q3,q4",State.state_from_string('10001')))
		self.qc.apply_two_qubit_gate_CNOT("q0","q1") # Before: 10001 After: 11001
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2,q3,q4",State.state_from_string('11001')))
		self.qc.apply_two_qubit_gate_CNOT("q1","q4") # Before: 11001 After: 11000
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2,q3,q4",State.state_from_string('11000')))
		self.qc.apply_two_qubit_gate_CNOT("q1","q4") # Before: 11000 After: 11001
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2,q3,q4",State.state_from_string('11001')))
		self.qc.apply_two_qubit_gate_CNOT("q4","q1") # Before: 11001 After: 10001
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2,q3,q4",State.state_from_string('10001')))
		self.qc.apply_two_qubit_gate_CNOT("q4","q3") # Before: 10001 After: 10011
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2,q3,q4",State.state_from_string('10011')))
		self.qc.apply_two_qubit_gate_CNOT("q3","q4") # Before: 10011 After: 10010
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2,q3,q4",State.state_from_string('10010')))
		self.qc.apply_two_qubit_gate_CNOT("q2","q4") # Before: 10010 After: 10010
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2,q3,q4",State.state_from_string('10010')))
		self.qc.apply_two_qubit_gate_CNOT("q1","q4") # Before: 10010 After: 10010
		self.assertTrue(self.qc.qubit_states_equal("q0,q1,q2,q3,q4",State.state_from_string('10010')))

	def test_execute_bluestate(self):
		"""Tests h,t,s,and bloch syntax on one qubit"""
		# This is a program to generate the 'blue state' in IBM's exercise
		self.qc.execute(Programs.program_blue_state.code)
		# check if we are in the blue state
		blue_state=Gate.H*Gate.S*Gate.T*Gate.H*Gate.T*Gate.H*Gate.S*Gate.T*Gate.H*Gate.T*Gate.H*Gate.T*Gate.H*State.zero_state
		self.assertTrue(self.qc.bloch_coords_equal("q1",State.get_bloch(blue_state)))
		# check to make sure we didn't change any other qubits in the QC

		for unchanged_state in ["q0","q2","q3","q4"]:
			self.assertTrue(self.qc.qubit_states_equal(unchanged_state,State.zero_state))
	def test_execute_X_Y_Z_Measure_Id_Sdag_Tdag(self):
		"""Tests z,y,measure,id,sdag,tdag syntax on all 5 qubits"""
		self.qc.execute(Programs.program_test_XYZMeasureIdSdagTdag.code)
		# result should be 01101
		self.assertTrue(self.qc.qubit_states_equal("q0",State.zero_state))
		self.assertTrue(self.qc.qubit_states_equal("q1",State.one_state))
		self.assertTrue(self.qc.qubit_states_equal("q2",State.one_state))
		self.assertTrue(self.qc.qubit_states_equal("q3",State.zero_state))
		self.assertTrue(self.qc.qubit_states_equal("q4",State.one_state))

	def test_execute_cnot(self):
		"""Tests cnot"""
		self.qc.execute(Programs.program_test_cnot.code)
		# result should be 01100
		self.assertTrue(self.qc.qubit_states_equal("q0",State.zero_state))
		self.assertTrue(self.qc.qubit_states_equal("q1",State.one_state))
		self.assertTrue(self.qc.qubit_states_equal("q2",State.one_state))
		self.assertTrue(self.qc.qubit_states_equal("q3",State.zero_state))
		self.assertTrue(self.qc.qubit_states_equal("q4",State.zero_state))


	def test_execute_many(self):
		"""Tests z,y,cnot,measure,id,sdag,tdag syntax on all 5 qubits"""
		self.qc.execute(Programs.program_test_many.code)
		# result should be 01001
		self.assertTrue(self.qc.qubit_states_equal("q0",State.zero_state))
		self.assertTrue(self.qc.qubit_states_equal("q1",State.one_state))
		self.assertTrue(self.qc.qubit_states_equal("q2",State.zero_state))
		self.assertTrue(self.qc.qubit_states_equal("q3",State.zero_state))
		self.assertTrue(self.qc.qubit_states_equal("q4",State.one_state))
	# These tests will be enabled after entanglement is supported properly
	# # Bell state experiments
	def test_bellstate_programs(self):
		# This tests two qubit entanglement.
		for program,result_probs,result_cor in zip([Programs.program_zz,Programs.program_zw,Programs.program_zv,Programs.program_xw,Programs.program_xv],
				[(0.5,0,0,0.5),(0.426777,0.073223,0.073223,0.426777),(0.426777,0.073223,0.073223,0.426777),(0.426777,0.073223,0.073223,0.426777),(0.073223,0.426777,0.426777,0.073223)],
				[1,1/sqrt(2),1/sqrt(2),1/sqrt(2),-1/sqrt(2)]):
			self.qc.reset()
			self.qc.execute(program.code)
			state_before_measure=self.qc.qubits.get_quantum_register_containing("q1").get_noop()
			probs=Probability.get_probabilities(state_before_measure)
			corex=Probability.get_correlated_expectation(state_before_measure)
			self.assertTrue(np.allclose(probs,result_probs))
			self.assertAlmostEqual(corex,result_cor)

	def test_ghz(self):
		program=Programs.program_ghz
		self.qc.reset()
		self.qc.execute(program.code)
		state_before_measure=self.qc.qubits.get_quantum_register_containing("q1").get_noop()
		probs=Probability.get_probabilities(state_before_measure)
		self.assertTrue(np.allclose(probs,program.result_probability))

	def test_ghz_measure_xxx(self):
		program=Programs.program_ghz_measure_xxx
		self.qc.reset()
		self.qc.execute(program.code)
		state_before_measure=self.qc.qubits.get_quantum_register_containing("q1").get_noop()
		probs=Probability.get_probabilities(state_before_measure)
		self.assertTrue(np.allclose(probs,program.result_probability))

	def test_ghz_measure_yyx(self):
		program=Programs.program_ghz_measure_yyx
		self.qc.reset()
		self.qc.execute(program.code)
		state_before_measure=self.qc.qubits.get_quantum_register_containing("q1").get_noop()
		probs=Probability.get_probabilities(state_before_measure)
		self.assertTrue(np.allclose(probs,program.result_probability))


	def test_ghz_measure_yxy(self):
		program=Programs.program_ghz_measure_yxy
		self.qc.reset()
		self.qc.execute(program.code)
		state_before_measure=self.qc.qubits.get_quantum_register_containing("q0").get_noop()
		probs=Probability.get_probabilities(state_before_measure)
		self.assertTrue(np.allclose(probs,program.result_probability))

	def test_ghz_measure_xyy(self):
		program=Programs.program_ghz_measure_xyy
		self.qc.reset()
		self.qc.execute(program.code)
		state_before_measure=self.qc.qubits.get_quantum_register_containing("q0").get_noop()
		probs=Probability.get_probabilities(state_before_measure)
		self.assertTrue(np.allclose(probs,program.result_probability))
		
	def test_program_swap_q0_q1(self):
		program=Programs.program_swap_q0_q1
		self.qc.reset()
		self.qc.execute(program.code)
		for qubit,bloch in zip(["q0","q1","q2","q3","q4"],program.bloch_vals):
			if bloch:
				self.assertTrue(self.qc.bloch_coords_equal(qubit,bloch))

	def test_program_controlled_hadamard(self):
		program=Programs.program_controlled_hadamard
		self.qc.reset()
		self.qc.execute(program.code)
		for qubit,bloch in zip(["q0","q1","q2","q3","q4"],program.bloch_vals):
			if bloch:
				self.assertTrue(self.qc.bloch_coords_equal(qubit,bloch))

	def test_reverse_cnot(self):
		program=Programs.program_reverse_cnot
		self.qc.reset()
		self.qc.execute(program.code)
		state_before_measure=self.qc.qubits.get_quantum_register_containing("q2").get_noop()
		probs=Probability.get_probabilities(state_before_measure)
		self.assertTrue(np.allclose(probs,program.result_probability))

	def test_program_swap(self):
		program=Programs.program_swap
		self.qc.reset()
		self.qc.execute(program.code)
		state_before_measure=self.qc.qubits.get_quantum_register_containing("q2").get_noop()
		probs=Probability.get_probabilities(state_before_measure)
		self.assertTrue(np.allclose(probs,program.result_probability))

	def test_program_approximate_sqrtT(self):
		program=Programs.program_approximate_sqrtT
		self.qc.reset()
		self.qc.execute(program.code)
		for qubit,bloch in zip(["q0","q1","q2","q3","q4"],program.bloch_vals):
			if bloch:
				self.assertTrue(self.qc.bloch_coords_equal(qubit,bloch))

	def test_program_toffoli_state_with_flips(self):
		program=Programs.program_toffoli_with_flips
		self.qc.reset()
		self.qc.execute(program.code)
		state_before_measure=self.qc.qubits.get_quantum_register_containing("q1").get_noop()
		probs=Probability.get_probabilities(state_before_measure)
		self.assertTrue(np.allclose(probs,program.result_probability))

	def test_program_toffoli_state(self):
		program=Programs.program_toffoli_state
		self.qc.reset()
		self.qc.execute(program.code)
		# we are going to reset things back to before they were measured
		on_qubit=self.qc.qubits.get_quantum_register_containing("q0")
		on_qubit.set_state(on_qubit.get_noop())
		self.assertTrue(self.qc.probabilities_equal("q0,q1,q2",np.array(program.result_probability)))

	def test_grover(self):
		for program in Programs.all_grover_tests:
			self.qc.reset()
			self.qc.execute(program.code)
			state_before_measure=self.qc.qubits.get_quantum_register_containing("q1").get_noop()
			probs=Probability.get_probabilities(state_before_measure)
			self.assertTrue(np.allclose(probs,program.result_probability))

	def test_program_encoder_into_bitflip_code(self):
		# Simply fails
		program=Programs.program_encoder_into_bitflip_code
		self.qc.reset()
		self.qc.execute(program.code)
		state_before_measure=self.qc.qubits.get_quantum_register_containing("q1").get_noop()
		probs=Probability.get_probabilities(state_before_measure)
		self.assertTrue(np.allclose(probs,program.result_probability,atol=1e-3))

	def test_program_encoder_into_bitflip_code_parity_checks(self):
		program=Programs.program_encoder_into_bitflip_code_parity_checks
		self.qc.reset()
		self.qc.execute(program.code)
		# we are going to reset things back to before they were measured
		on_qubit=self.qc.qubits.get_quantum_register_containing("q0")
		on_qubit.set_state(on_qubit.get_noop())
		self.assertTrue(self.qc.probabilities_equal("q0,q1,q2,q3,q4",np.array(program.result_probability)))


	def test_program_deutschjozsa_constant_n3(self):
		program=Programs.program_deutschjozsa_n3
		self.qc.reset()
		self.qc.execute(program.code)
		state_before_measure=self.qc.qubits.get_quantum_register_containing("q1").get_noop()
		probs=Probability.get_probabilities(state_before_measure)
		self.assertTrue(np.allclose(probs,program.result_probability))

	def test_program_deutschjozsa_n3(self):
		program=Programs.program_deutschjozsa_n3
		self.qc.reset()
		self.qc.execute(program.code)
		state_before_measure=self.qc.qubits.get_quantum_register_containing("q1").get_noop()
		probs=Probability.get_probabilities(state_before_measure)
		self.assertTrue(np.allclose(probs,program.result_probability))

	def test_plaquette_code(self):
		for program in Programs.all_normal_plaquette_programs:
			self.qc.reset()
			self.qc.execute(program.code)
			state_before_measure=self.qc.qubits.get_quantum_register_containing("q2").get_noop()
			probs=Probability.get_probabilities(state_before_measure)
			self.assertTrue(np.allclose(probs,program.result_probability))

	def test_plaquette_zXplusminusplusminus(self):
		program=Programs.program_plaquette_zXplusminusplusminus
		self.qc.reset()
		self.qc.execute(program.code)
		state_before_measure=self.qc.qubits.get_quantum_register_containing("q2").get_noop()
		probs=Probability.get_probabilities(state_before_measure)
		self.assertTrue(np.allclose(probs,program.result_probability))

	def test_program_encoder_and_decoder_tomography(self):
		program=Programs.program_encoder_and_decoder_tomography
		self.qc.reset()
		self.qc.execute(program.code)
		for qubit_name,bloch in zip(["q0","q1","q2","q3","q4"],program.bloch_vals):
			if bloch:
				self.assertTrue(self.qc.bloch_coords_equal(qubit_name,bloch))
	def tearDown(self):
		print self._testMethodName, "%.3f" % (time.time() - self.startTime)
		self.qc=None

if __name__ == '__main__':
 	unittest.main()
